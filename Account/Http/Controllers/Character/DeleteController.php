<?php

namespace Bitaac\Account\Http\Controllers\Character;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Bitaac\Account\Http\Requests\Character\DeleteRequest;

class DeleteController extends Controller
{
    /**
     * Create a new delete controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the delete character form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::account.character.delete');
    }

    /**
     * Process the character delete.
     *
     * @param \Bitaac\Account\Http\Requests\Character\DeleteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function post(DeleteRequest $request)
    {
        $user = $this->auth->user();

        if (! $this->auth->attempt(['name' => $user->name, 'password' => $request->get('password')])) {
            return back()->withError('Password do not match.');
        }

        $player = app('player')->where(function ($query) use ($user, $request) {
            $query->where('account_id', $user->id);
            $query->where('name', $request->get('character'));
        });

        if (config('bitaac.account.delete-character-time') == 0) {
            $player->delete();

            return redirect('/account')->withSuccess('Your character has been deleted.');
        }

        $player = $player->first();
        $player->bitaac->deletion_time = time() + config('bitaac.account.delete-character-time');
        $player->bitaac->save();

        return redirect('/account')->withSuccess(
            'Your character '.$player->name.' will be deleted at '.Carbon::createFromTimestamp($player->bitaac->deletion_time).'.'
        );
    }
}
