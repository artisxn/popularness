<?php

namespace App\Traits;

use App\Wallet;

trait WalletTrait
{

    public static function depositToEarningBalance($walletId, $amount)
    {
        $wallet = Wallet::find($walletId);
        $wallet->earning_balance += $amount;
        if ($wallet->save()) {
            return TRUE;
        }
        return FALSE;
    }


    public static function depositToDepositBalance($walletId, $amount)
    {
        $wallet = Wallet::find($walletId);
        $wallet->deposit_balance += $amount;
        if ($wallet->save()) {
            return TRUE;
        }
        return FALSE;
    }


    public static function deductedFromDepositBalance($walletId, $amount)
    {
        $wallet = Wallet::find($walletId);
        $wallet->deposit_balance -= $amount;
        if ($wallet->save()) {
            return TRUE;
        }
        return FALSE;
    }
}