<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserChangeEmailRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserChangePasswordRequest;

class UserSettingController extends Controller
{
    public function index()
    {
        return view('user.setting.index');
    }
    public function updatePassword( UserChangePasswordRequest $request)
    {

        if(Hash::check( $request->input('old_password') , auth()->user()->password ))
        {
            auth()->user()->update([ 'password' => Hash::make($request->input('new_password'))  ]);

            return redirect()->route('user.setting.index')->with('messagePassword', 'Password changed succesfully!');
        }

        return redirect()->route('user.setting.index')->with('wrongPassword', 'Check your old password!');

    }
    public function updateEmail( UserChangeEmailRequest $request)
    {
        if(Hash::check( $request->input('password') , auth()->user()->password ))
        {
            auth()->user()->update([ 
                'email' => $request->input('new_email'),
                'email_verified_at' => null
                
                ]);

            return redirect()->route('user.setting.index')->with('messageEmail', 'Email changed succesfully!');
        }

        return redirect()->route('user.setting.index')->with('wrongEmailPassword', 'Check your old password!');
    }
}
