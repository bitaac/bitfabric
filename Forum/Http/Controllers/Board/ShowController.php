<?php

namespace Bitaac\Forum\Http\Controllers\Board;

use Bitaac\Contracts\Forum\Board;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * Show the board page.
     *
     * @param  \Bitaac\Contracts\Forum\Board $board
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        return view('bitaac::forum.board.show', [
            'board'   => $board,
            'threads' => $board->threads()->paginate(10),
        ]);
    }
}
