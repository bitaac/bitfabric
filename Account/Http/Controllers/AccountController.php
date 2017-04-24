<?php

namespace Bitaac\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the index page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bitaac::account.dashboard');
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->auth->logout();

        return redirect('/')->withSuccess('You have successfully logged out from your account.');
    }
}
