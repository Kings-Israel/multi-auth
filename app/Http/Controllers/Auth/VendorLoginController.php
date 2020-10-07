<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.vendor-login');
    }

    public function login(Request $request)
    {
        //validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Attempt to log in the user
        if (Auth::guard('vendor')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            return redirect()->intended(route('vendor.dashboard'));
        }

        // if unsuccessful
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
