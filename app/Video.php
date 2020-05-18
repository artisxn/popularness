<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class Video extends Model
{

    use Actionable,SoftDeletes;


    protected $fillable = [
        'title', 'user_id', 'size', 'videotype', 'artistname', 'hash_id', 'image', 'genres', 'maingenres', 'wistia',
        'views', 'status'
    ];


    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function genre()
    {

        return $this->belongsTo('App\Genre', 'genres');
    }

    public function earningTransactionTotal()
    {
        return $this->hasMany('App\Transaction', 'product_id', 'id')
            ->where('wallet_type', 2)
            ->selectRaw('product_id,SUM(amount) as total')
            ->groupBy('product_id');
    }


}
