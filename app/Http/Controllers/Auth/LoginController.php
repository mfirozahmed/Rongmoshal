<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Code;
use Session;
use Auth;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'userLogout');
    }

    public function showLoginForm()
    {
        $data = Code::categoryList();
        return view('auth.login')->with($data);
    }

    public function login(Request $request)
    {
        //Validate the form data
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ],
        [
            'email.required' => 'Please enter your registered email.',
            'password.required' => 'Please enter your password.',
            'email.email' => 'Email is not valid',
            'email.exists' => 'These credentials do not match our records.',
        ]);

        //Attempt to log the user in
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // successful-> redirect to intended location
            return redirect()->intended(route('home'));
        }
        
        Session::flash('error', 'These credentials do not match our records.');
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}
