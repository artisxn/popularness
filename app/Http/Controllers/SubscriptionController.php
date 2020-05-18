<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Support\Facades\Auth;
use App\User;

class SubscriptionController extends Controller
{

    public function index()
    {

        $package = $this->loggedUserPackage();

        if ($package == null) {
            return redirect()->back();
        }

        return view('client.subscription', ['package' => $package]);
    }

    public function changeSubscription()
    {

        $package = $this->loggedUserPackage();

        if ($package == null) {
            return redirect()->back();
        }

        return view('client.change_subscription', ['package' => $package]);

    }

    //TODO:: Need to handle package changing procedure dynamically

    public function changePackage()
    {

        $package = $this->loggedUserPackage();

        if ($package == null) {
            return redirect()->back();
        }

        $package = Package::where('price', '>', 0)->first();

        if ($package == null) {
            return redirect()->back();
        }

        $userId = Auth::user()->id;

        $user = User::find($userId);

        $user->package_id = $package->id;

        $user->save();
        return redirect()->route('my-subscription');

    }

    private function loggedUserPackage()
    {

        $userData = Auth::user();

        $userType = $userData->user_type;

        if ($userType == 1) {// if user fan
            return redirect()->back();
        }
        $userPackageId = $userData->package_id;

        return Package::find($userPackageId);

    }

}
