<?php

namespace App\Http\Controllers\AuthKasir;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/kasir/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function guard(){
        return auth()->guard('admin');
    }

    public function showLoginForm(){
        return view('kasir.login-kasir');
    }

    protected function authenticated(Request $request, $user)
    {
        if ( $user->role=='kasir' ) {// do your margic here
            return redirect()->route('kasir.dashboard');
        }

        return redirect('/home');
    }
}
