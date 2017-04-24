<?php

namespace Bitaac\Account\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Bitaac\Account\Http\Requests\Character\CreateRequest;

class CreateController extends Controller
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
     * Show the create character form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::account.character.create');
    }

    /**
     * Process the character creation.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(CreateRequest $request)
    {
        if ($this->auth->user()->characters()->count() >= config('bitaac.account.max-characters')) {
            return back()->withError('You have already reached maximum characters per account.');
        }

        app('player')->make($request->all());

        return back()->withSuccess('Your character has been created.');
    }
}
