<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        if (Auth::check()) {
            $data = Code::categoryList();
            $token_user = User::find(Auth::user()->id);
            return view('frontend.user.profile')->with('token_user', $token_user)->with($data);
        }
        
        Session::flash('error', 'Unauthorised Access Detected!');
        return redirect()->route('home');
    }

    public function profile_update()
    {
        if (Auth::check()) {
            $data = Code::categoryList();
            $token_user = User::find(Auth::user()->id);
            return view('frontend.user.profile_update')->with('token_user', $token_user)->with($data);
        }

        Session::flash('error', 'Unauthorised Access Detected!');
        return redirect()->route('home');
    }

    public function profile_submit(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'phone' => ['required', 'string', 'size:11'],
            'password' => 'required'
        ],
        [
            'name.required' => 'Enter your name please.',
            'address.required' => 'Enter your address please.',
            'phone.required' => 'Enter a valid phone number please.',
            'password.required' => 'Please Enter your password to proceed.'
        ]);

        if (Auth::check()) {
            
            $token_user = User::find(Auth::user()->id);

            if (!(Hash::check($request->password, $token_user->password))){
                Session::flash('error', 'Password does not match.');
                return back();
            }
    
            $token_user->name = $request->name;
            $token_user->phone = $request->phone;
            $token_user->address = $request->address;
    
            if ($request->new_password != null) {
                if ($request->new_password == $request->confirm_password) {
                    $token_user->password = Hash::make($request->new_password);
                }
            }
            
            $token_user->save();
            Session::flash('success', 'Profile updated successfully.');
            return redirect()->route('user.dashboard');
        }

        Session::flash('error', 'Unauthorised Access Detected!');
        return redirect()->route('home');
    }

    public function order()
    {
        $data = Code::categoryList();
        if (Auth::check()) {
            $token_user = User::find(Auth::user()->id);
            $orders = Order::where('user_id', $token_user->id)->get();
        } else {
            $orders = Order::where('user_id', request()->ip())->get();
            
        }
        return view('frontend.user.order')->with('orders', $orders)->with($data);
    }

}
