<?php

namespace Bitaac\Core\Http\Controllers\Account\Character;

use App\Http\Controllers\Controller;

class UndeleteController extends Controller
{
    /**
     * Show the undelete character form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($player)
    {
        if (! $player->hasPendingDeletion()) {
            return redirect('/account');
        }

        return view('bitaac::account.character.undelete')->with(compact('player'));
    }

    /**
     * Process the character undelete.
     *
     * @return \Illuminate\Http\Response
     */
    public function post($player)
    {
        $player->bitaac->deletion_time = 0;
        $player->bitaac->save();

        return redirect('/account')->withSuccess("Character {$player->name} has been undeleted.");
    }
}
