<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $wallet_type,$wallet_id,$amount,$product_id,$opt_type,$type,$confirmed;

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

    public function video()
    {
        return $this->belongsTo('App\Video', 'product_id');

    }
}
