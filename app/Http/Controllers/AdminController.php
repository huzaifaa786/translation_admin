<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);

        $remember = $request->remember == 'on' ? true : false;
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::guard('admin')->attempt($credentials,$remember)) {
        //   toastr()->success(' login successfully ');
            return redirect()->intended('admin/layout');
        }
        // toastr()->error('Incorrect email or password');
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'approve' => 'Wrong password or this account not approved yet.',
        ]);
    }
        public function logout()
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin/login');
        }
}
