<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{


    public function myWallet(){

        return $this->belongsTo('App\User');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

}
