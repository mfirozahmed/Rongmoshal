<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //Error messages
        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "These credentials do not match our records.",
            "password.required" => "Password is required",
        ];

        //Validate the form data

        /* $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]); */

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins',
            'password' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //Attempt to log the user in

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // successful-> redirect to intended location

            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'approve' => 'Wrong password or this account is not approved yet.',
        ]);
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
