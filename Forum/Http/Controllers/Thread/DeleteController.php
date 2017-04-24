<?php

namespace Bitaac\Forum\Http\Controllers\Thread;

use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    /**
     * Show the thread delete form to the user.
     *
     * @param  string  $board
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function form($board, $thread)
    {
        return view('bitaac::forum.thread.delete', [
            'thread' => $thread,
            'board'  => $board,
        ]);
    }

    /**
     * Process the thread & replies deletion.
     *
     * @param  string  $board
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function post($board, $thread)
    {
        $thread->delete();
        $thread->deleteReplies();

        return redirect($board->link())->withSuccess('Thread has been deleted.');
    }
}
