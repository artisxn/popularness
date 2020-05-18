<?php

namespace App\Http\Controllers;

use App\Traits\TransactionTrait;
use App\Traits\WalletTrait;
use Illuminate\Support\Facades\DB;
use App\Mail\DepositBalanceDeducted;
use App\Mail\EarningBalanceUpdated;
use App\Video;
use App\Transaction;
use App\User;
use App\VideoPolicy;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Helper\SlackHelper;

class TransactionController extends Controller
{
    public function balance()
    {
        return view('client.balance');
    }

    public function myBalance()
    {
        $userId = Auth::id();
        $balance = User::with('wallet')->find($userId);
        return response()->json($balance);
    }

    public function videoContribution(Request $request)
    {
        $userId = Auth::id();
        $data = $request->all();
        $videoId = $data['videoId'];
        $amount = $data['amount'];
        $depositBalance = $this->_getDepositAmount($userId);

        //checking Balance available to contribution
        if ($depositBalance->deposit_balance < $amount) {

            return response()->json(['status' => 'error', 'message' => "Insufficient Balance."]);
        }

        $walletId = $depositBalance->id;

        $videoPolicyChecking = $this->_videoPolicyChecking($walletId, $userId, $videoId, $amount);

        if ($videoPolicyChecking['status'] == 'success') {

            $this->_doTransaction($walletId, $videoId, $amount);

            $response = $this->_getVideoTransactions($videoId);

            return response()->json([
                'status' => 'success',
                'message' => "Your contribution successfully done on the video.",
                'count' => $response['count'],
                'amount' => $response['amount']
            ]);
        }

        return response()->json($videoPolicyChecking);
    }

    private function _getDepositAmount($userId)
    {
        return Wallet::where('user_id', $userId)->first();
    }

    private function _videoPolicyChecking($walletId, $userId, $videoId, $amount)
    {
        $policy = VideoPolicy::first();

        // policy data checking
        if (empty($policy)) {

            $response = [
                'status' => 'error',
                'message' => "You can't contribute right now due to technical issues"
            ];
            SlackHelper::send($response['message']);
            return $response;
        }
        //checking min and max range according video policy

        if ($amount == "" || $amount < $policy->min_amount || $amount > $policy->max_amount) {
            $response = [
                'status' => 'error',
                'message' => "Please try contribute between $ $policy->min_amount and  $ $policy->max_amount"
            ];

            SlackHelper::send($response['message']);
            return $response;
        }

        $transaction = Transaction::where(['product_id' => $videoId, 'wallet_id' => $walletId])->get()->toArray();

        if (empty($transaction)) {
            return ['status' => 'success', 'message' => "You're eligible to contribute on the video"];
        }

        $count = collect($transaction)->count();
        $totalAmount = collect($transaction)->sum('amount');

        if ($count >= $policy->max_transaction) {
            return [
                'status' => 'error',
                'message' => "You can't contribute on the video as you already reached maximum transactions  ($policy->max_transaction) times"
            ];
        }

        if (($totalAmount + $amount) > $policy->total_amount) {
            return [
                'status' => 'error',
                'message' => "You can't contribute on the video as you already reached maximum amounts  ($policy->total_amount) $"
            ];
        }

        return ['status' => 'success', 'message' => "You're eligible to contribute on the video"];
    }

    private function _doTransaction($walletId, $videoId, $amount)
    {
        DB::beginTransaction();

        // earning part
        $video = Video::find($videoId);
        $videoUserId = $video->user_id;
        $videoUserWallet = Wallet::where('user_id', $videoUserId)->first();

        if ( ! TransactionTrait::transactionAsEarning($videoUserWallet->id, $amount, $videoId)) {
            DB::rollback();

            $response = [
                'status' => 'error',
                'message' => 'Something went Wrong!, please wait and try few moments later'
            ];
            SlackHelper::send($response['message']);
            return $response;
        }

        if ( ! WalletTrait::depositToEarningBalance($videoUserWallet->id, $amount)) {
            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Something went Wrong!, please wait and try few moments later'
            ];
            SlackHelper::send($response['message']);
            return $response;
        }

        if ( ! TransactionTrait::transactionAsDeposit($walletId, $amount, $videoId)) {
            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Something went Wrong!, please wait and try few moments later'
            ];
            SlackHelper::send($response['message']);
            return $response;
        }

        if ( ! WalletTrait::deductedFromDepositBalance($walletId, $amount)) {
            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Something went Wrong!, please wait and try few moments later'
            ];
            SlackHelper::send($response['message']);
            return $response;
        }
        /**/
        DB::commit();

        // Email sending to Earning User
        $EarningUser = USER::find($videoUserId);
        Mail::to($EarningUser)->send(new EarningBalanceUpdated($amount));

        // Email sending to Deposit User
        $user = Auth::user();
        Mail::to($user)->send(new DepositBalanceDeducted($amount));

        return ['status' => 'success', 'message' => 'Operation successfully done.'];
    }

    public function getVideoTransactions($videoId)
    {
        return response()->json($this->_getVideoTransactions($videoId));
    }

    private function _getVideoTransactions($videoId)
    {
        $transactions = Transaction::where(['product_id' => $videoId, 'wallet_type' => 2])->get();
        return [
            'count' => collect($transactions)->groupBy('wallet_id')->count(),
            'amount' => collect($transactions)->sum('amount')
        ];
    }
}