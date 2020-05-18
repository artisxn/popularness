<?php

namespace App\Http\Middleware;

use App\Package;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $package = Package::find($user->package_id);
        if($package->price > 0 && $user->stripe_id == NULL){
            return Redirect::route('stripe-payment');
        }else{
            return $next($request);
        }


    }
}
