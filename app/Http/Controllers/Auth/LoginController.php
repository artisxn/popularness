<?php

namespace App\Http\Controllers\Auth;

use App\Genre;
use App\Http\Controllers\Controller;
use App\Package;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }




    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }


    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if($user){
            Auth::login($user);
            return redirect()->action('HomeController@index');
        }else{
            $genres = Genre::all();
            $packages = Package::all();

            $firstName = $userSocial->getName();
            $ex = explode(' ',$firstName);
            $lastKey = array_key_last($ex);
            $last_name = "";
            if($lastKey!= 0){
                $last_name =$ex[$lastKey];
                $firstName = str_replace($last_name, "", $firstName);
            }

            return view('artist_register',['provider_id'=>$userSocial->getId(),'first_name' => $firstName,'last_name'=>$last_name, 'email' => $userSocial->getEmail(),'genres'=>$genres,'packages'=>$packages]);
        }
    }

}
