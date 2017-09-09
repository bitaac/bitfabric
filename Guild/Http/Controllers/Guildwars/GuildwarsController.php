<?php

namespace Bitaac\Guild\Http\Controllers\Guildwars;

use Bitaac\Guild\Models\GuildWar;
use App\Http\Controllers\Controller;

class GuildwarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guildwars.enabled']);
    }

    /**
     * Show the guild wars page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wars = GuildWar::all();

        return view('bitaac::guilds.guildwars.index')->with([
            'wars' => $wars,
        ]);
    }
}
