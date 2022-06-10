<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show() {
        return view('auth.login');
    }
    
    public function login(LoginRequest $request) {
        $credentials = $request->getCredentials();
        if (!Auth::validate($credentials)) {
            return redirect('/login')->with('dangerMessage', 'Invalid Credentials');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user) {
        if (Auth::user()->role == 'admin') {
            return redirect('admin/dashboard')->with('successMessage', 'Login Successfull');
        } else {
            return redirect('/')->with('successMessage', 'Login Successfull');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
