<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vendor;
use Illuminate\Support\Facades\Hash;

class VendorRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor');
    }

    public function showRegisterForm()
    {
        return view('auth.vendor-register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'=>['required','string'],
            'email'=>['required','email'],
            'password'=>['required', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
        Vendor::create($request->all());

        return redirect()->intended(route('vendor.dashboard'));
    }
}
