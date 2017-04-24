<?php

namespace Bitaac\Forum\Http\Controllers\Board;

use Bitaac\Forum\Board;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * Show the board and its threads to the user.
     *
     * @param  \Bitaac\Forum\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function index($board)
    {
        return view('bitaac::forum.board.show', [
            'board'   => $board,
            'threads' => $board->threads()->paginate(10),
        ]);
    }
}
