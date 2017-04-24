<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;

class OnlineController extends Controller
{
    /**
     * Show the online page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $player = app('player');

        $online = $player->getOnlineList();

        return view('bitaac::community.online')->with(compact('player', 'online'));
    }
}
