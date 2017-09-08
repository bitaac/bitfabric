<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\Forum\Board;
use App\Http\Controllers\Controller;

class BoardsController extends Controller
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
     * Show the forum boards page.
     *
     * @param  \Bitaac\Contracts\Forum\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        return view('admin::boards.index')->with([
            'boards' => $board->all(),
        ]);
    }
}
