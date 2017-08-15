<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Role;
use Session;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        Session::put('roles', Auth::User()->role);

        Session::put('role', Auth::User()->role);

        if(Role::whereId(Session::get('role'))->value('name') == "manager"){
            return 'manager/dashboard';
        }else{
            return 'logout';
        }
    }

    /**
     * Override the username method used to validate login
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}
