<?php

namespace Bitaac\Account\Http\Controllers\Change;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Bitaac\Account\Http\Requests\Change\EmailRequest;

class EmailController extends Controller
{
    /**
     * Create a new email controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the change email form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::account.change.email');
    }

    /**
     * Process the email change.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(EmailRequest $request)
    {
        $user = $this->auth->user();
        $time = config('bitaac.account.change-email-time');

        if (! $this->auth->validate(['name' => $user->name, 'password' => $request->get('password')])) {
            return back()->withError('Password did not match.');
        }

        if ($time == 0) {
            $user->email = $request->get('email');
            $user->save();

            return back()->withSuccess('Your email has been updated.');
        }

        $updates = Carbon::now()->addSeconds($time)->toDateTimeString();

        $user->bit->email_change_time = strtotime($updates);
        $user->bit->email_change_new = $request->get('email');
        $user->bit->save();

        return back()->withSuccess('You have requested to change your email address to '.$request->get('email').'. The actual change will take place after '.$updates.', during which you can cancel the request at any time.');
    }
}
