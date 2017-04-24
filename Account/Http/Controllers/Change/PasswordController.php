<?php

namespace Bitaac\Account\Http\Controllers\Change;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Bitaac\Account\Http\Requests\Change\PasswordRequest;

class PasswordController extends Controller
{
    /**
     * Create a new password controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the change password form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::account.change.password');
    }

    /**
     * Process the password change.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(PasswordRequest $request)
    {
        $user = auth()->user();

        if (! auth()->validate(['name' => $user->name, 'password' => $request->get('current')])) {
            return back()->withError('Current password do not match.');
        }

        $user->password = bcrypt($request->get('password'));
        $user->save();

        return back()->withSuccess('Your password has been updated.');
    }
}
