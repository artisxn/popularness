<?php

namespace App\Http\Controllers;

use App\Helper\SlackHelper;
use App\Mail\BalanceLoaded;
use App\Package;
use App\Transaction;
use App\User;
use App\Wallet;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Stripe;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{

    public function __construct()
    {
//        $this->middleware(function ($request, $next) {
//
//            if(!$this->eligibilityChecking()){
//                return Redirect::route('client-home');
//            }
//            return $next($request);
//
//        });
    }

    public function stripe()
    {
        $user = Auth::user();
        $packagePrice = Package::find($user->package_id)->price;
        return view('stripe', ['amount' => $packagePrice]);
    }

    public function stripePost(Request $request)
    {

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $chargesAmount = Package::find($user->package_id)->price;

        $amount = $chargesAmount * 100;


//        $user->createAsStripeCustomer(['email'=> $user->email,'description'=>'Create Customer for popularness']);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripePayment = Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment from popularness.com ($user->name)"
        ]);

        $user->stripe_id = $stripePayment->id;
        $user->card_brand = $stripePayment->source->brand;
        $user->card_last_four = $stripePayment->source->last4;
        $user->save();
        return Redirect::route('client-home');
    }

    public function depositWallet(Request $request)
    {

        $userId = Auth::user()->id;
        $user = User::with('wallet')->find($userId);

        $chargesAmount = $request['stripeAmount'];
        $amount = $chargesAmount * 100;


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripePayment = Stripe\Charge::create([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment from popularness.com ($user->name)"
        ]);

        DB::beginTransaction();

        $transaction = new Transaction();
        $transaction->wallet_type = 1;
        $transaction->wallet_id = $user->wallet->id;
        $transaction->amount = $chargesAmount;
        $transaction->opt_type = 1;
        $transaction->type = 1;
        $transaction->confirmed = 1;
        $transaction->meta = json_encode($stripePayment);

        if(!$transaction->save()){

            DB::rollback();

            $response = [
                'status' => 'error',
                'message' => 'Something went Wrong in Balance loading system!, please wait and try few moments later'
            ];
            SlackHelper::send($response['message']);
            return response()->json($response);
        }
        $wallet = Wallet::find($user->wallet->id);
        $wallet->deposit_balance = $user->wallet->deposit_balance + $chargesAmount;
        if(!$wallet->save()){

            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Something went Wrong in Balance loading system!, please wait and try few moments later'
            ];
            SlackHelper::send($response['message']);
            return response()->json($response);
        }

        DB::commit();

        // Email sending
        $user = Auth::user();
        Mail::to($user)->send(new BalanceLoaded($chargesAmount));

        $balance = User::with('wallet')->find($userId);
        return response()->json($balance);
    }

    public function eligibilityChecking()
    {

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $package = Package::find($user->package_id);

        if ($package->price <= 0 || $user->stripe_id != null) {
            return false;
        }
        return true;
    }
}
