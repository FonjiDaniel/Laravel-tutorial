<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(
        Request $request
    ) {
        $incomingData = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'password' => ['required',  Rule::unique('users', 'password')],
            'email' => 'required'
        ]);
        $incomingData['password'] = bcrypt($incomingData['password']);
        User::create($incomingData);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect('/');
        }

        return 'failed to login';
    }

    public function login(Request $request)
    {

        $incomingFields = $request->validate([
            'loginemail' => 'required',
            'loginpassword' => 'required'
        ]);

        $credentials = $request->only('loginemail', 'loginpassword');
        if (Auth::attempt(['email'=> $incomingFields['loginemail'], 'password' =>$incomingFields['loginpassword']  ])) {
            $request->session()->regenerate();
            return redirect('/');
        }
 

    }

    public function logout()
    {

        Auth::logout();
        return redirect('/');
    }
}
