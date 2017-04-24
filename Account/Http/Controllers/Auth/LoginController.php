<?php

namespace Bitaac\Account\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Bitaac\Account\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Create a new login controller instance.
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
        return view('bitaac::auth.login');
    }

    /**
     * Process the login.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(LoginRequest $request)
    {
        $user = app('account')->where(function ($query) use ($request) {
            $query->where('name', $request->get('account'));
            $query->where('password', bcrypt($request->get('password')));
        });

        if (! $user->exists()) {
            return back()->withError('These credentials do not match our records.');
        }

        $user = $user->first();

        if ($user->secret && config('account.two-factor')) {
            if ($request->get('2fa') == '') {
                return back()->withError(trans('auth.login.2fa.required'));
            }

            $valid = \Google2FA::verifyKey($user->secret, $request->get('2fa'));
            if (! $valid) {
                return back()->withError(trans('auth.login.2fa.not.valid'));
            }
        }

        $user->bitaac->updateLastLogin();
        $this->auth->loginUsingId($user->id);

        return redirect('/account')->withSuccess('You have been logged in.');
    }
}
