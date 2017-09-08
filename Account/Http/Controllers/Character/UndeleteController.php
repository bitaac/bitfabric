<?php

namespace Bitaac\Account\Http\Controllers\Character;

use Bitaac\Contracts\Player;
use App\Http\Controllers\Controller;

class UndeleteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'character.exists', 'owns.character']);
    }

    /**
     * Show the undelete character page.
     *
     * @param  \Bitaac\Contracts\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function form(Player $player)
    {
        if (! $player->hasPendingDeletion()) {
            return redirect()->route('account');
        }

        return view('bitaac::account.character.undelete')->with([
            'player' => $player,
        ]);
    }

    /**
     * Handle the undelete character request.
     *
     * @param  \Bitaac\Contracts\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function post(Player $player)
    {
        $player->bitaac->update([
            'deletion_time' => 0,
        ]);

        return redirect()->route('account')->with([
            'success' => "Character {$player->name} has been undeleted.",
        ]);
    }
}
