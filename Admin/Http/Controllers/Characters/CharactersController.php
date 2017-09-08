<?php

namespace Bitaac\Admin\Http\Controllers\Characters;

use Bitaac\Contracts\Player;
use App\Http\Controllers\Controller;

class CharactersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    /**
     * Show the admin characters page.
     *
     * @param  \Bitaac\Contracts\Account  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Player $player)
    {
        return view('admin::characters.index')->with([
            'characters' => $player->all(),
        ]);
    }
}
