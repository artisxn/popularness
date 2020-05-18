<?php

namespace App\Traits;

use App\Transaction;

trait TransactionTrait
{


    public static function transactionAsEarning($walletId, $amount, $productionId = null)
    {
        $transaction = new Transaction();
        $transaction->wallet_type = 2;
        $transaction->wallet_id = $walletId;
        $transaction->amount = $amount;
        $transaction->product_id = $productionId;
        $transaction->opt_type = 3;
        $transaction->type = 1;
        $transaction->confirmed = 1;
        if ($transaction->save()) {
            return TRUE;
        }
        return FALSE;

    }

    public static function transactionAsDeposit($walletId, $amount, $productionId = null)
    {
        $transaction = new Transaction();
        $transaction->wallet_type = 1;
        $transaction->wallet_id = $walletId;
        $transaction->amount = $amount;
        $transaction->product_id = $productionId;
        $transaction->opt_type = 2;
        $transaction->type = 1;
        $transaction->confirmed = 1;
        if ($transaction->save()) {
            return TRUE;
        }
        return FALSE;

    }
}