<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',

        ]);
        $imageName = null;
        $userId = auth()->user()->id;

        // Check if a profile image has been uploaded
        if ($request->has('profile_image')) {
            $image = $request->file('profile_image');

            $filePath = env('APP_ENV')."/user";
            $imagePath = Storage::disk('s3')->put($filePath, $image, 'public');
        }

        $data = $request->all();
        $userData = User::find($userId);
        //artist / brand name
        $userData->name = isset($data['name']) ? $data['name'] : null;
        $userData->first_name = $data['first_name'];
        $userData->last_name = $data['last_name'];
        $userData->dob = $data['dob'];

        if ($request->has('profile_image')) {

            $searchSting = $filePath.'/';
            //profile image will be delete from s3 if any
            if ($userData->image != 'NULL') {
                Storage::disk('s3')->delete($searchSting.$userData->image);
            }
            $dbImagePath = str_replace($searchSting, '', $imagePath);
            $userData->image = $dbImagePath;
        }

        $userData->gender = $data['gender'] == null ? 1 : (int) $data['gender'];
        $userData->save();

        return redirect('/home');
    }
}
