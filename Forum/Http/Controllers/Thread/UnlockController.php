<?php

namespace Bitaac\Forum\Http\Controllers\Thread;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnlockController extends Controller
{
    /**
     * Show the thread unlock form to the user.
     *
     * @param  \Bitaac\Forum\Board   $board
     * @param  \Bitaac\Forum\Post    $thread
     * @return \Illuminate\Http\Response
     */
    public function form($board, $thread)
    {
        if (! $thread->locked) {
            return redirect(url_e('/forum/:board/:thread', [
                'thread' => $thread->title,
                'board'  => $board->title,
            ]));
        }

        return view('bitaac::forum.thread.unlock', compact('board', 'thread'));
    }

    /**
     * Process the thread unlock.
     *
     * @param  \Bitaac\Forum\Board   $board
     * @param  \Bitaac\Forum\Post    $thread
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, $board, $thread)
    {
        $thread->unlock();

        return redirect($thread->link())->withSuccess("You have successfully unlocked thread {$thread->title}.");
    }
}
