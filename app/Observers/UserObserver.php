<?php

namespace App\Observers;

use App\Mail\UserStatusChanged;
use App\User;
use App\Wallet;
use Illuminate\Support\Facades\Mail;

class UserObserver
{


    public function updating(User $user){
        $userId = $user->id;
        $userInfo = User::find($userId);
        // if status not match then should be send email
        if($userInfo->is_active != $user->is_active){
            Mail::to($userInfo)->send(new UserStatusChanged($user));
        }

    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // wallet create after new user registered

        $wallet = new Wallet();
        $wallet->user_id =$user->id;
        $wallet->name ='Default Wallet';
        $wallet->slug ='wallet';
        $wallet->description ='System Generated wallet';
        $wallet->earning_balance =0;
        $wallet->deposit_balance =0;
        $wallet->save();

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
