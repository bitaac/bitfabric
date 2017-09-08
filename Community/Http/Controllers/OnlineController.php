<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;

class OnlineController extends Controller
{
    /**
     * Show the onlinelist page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bitaac::community.online')->with([
            'players' => getOnlinePlayers(),
        ]);
    }
}
