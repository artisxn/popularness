<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Nova\Actions\Actionable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable,Actionable,Billable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','last_name', 'email', 'password','primary_genre','package_id','user_type','provider_id','email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_END_POINT');
    }


    public function posts(){

        return $this->hasMany('App\Post');
    }


    public function videos(){
        return $this->hasMany('App\Video');
    }

    public function package(){
        return $this->belongsTo('App\Package');
    }

    public function wallet(){
        return $this->hasOne('App\Wallet');
    }


    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

}
