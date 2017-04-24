<?php

namespace Bitaac\Account\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Bitaac\Account\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
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
     * Show the login form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::auth.register');
    }

    /**
     * Process the login.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(RegisterRequest $request)
    {
        $account = app('account');
        $account->name = $request->get('account');
        $account->email = $request->get('email');
        $account->password = bcrypt($request->get('password'));
        $account->save();

        if (! $this->auth->attempt(['name' => $request->get('account'), 'password' => $request->get('password')])) {
            return back();
        }

        $bitaac = $account->bit;
        $bitaac->generateSecret();
        $bitaac->updateLastLogin();

        return redirect('/account')->withSuccess('Your account has successfully been created.');
    }
}
