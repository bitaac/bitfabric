<?php

namespace Bitaac\Forum\Http\Controllers\Thread;

use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * Show the thread to user.
     *
     * @param  \Bitaac\Forum\Board  $board
     * @param  \Bitaac\Forum\Post   $thread
     * @return \Illuminate\Http\Response
     */
    public function index($board, $thread)
    {
        $posts = $thread->replies()->paginate(10);

        if ($thread->lastip != $ip = ip2long(request()->ip())) {
            $thread->lastip = $ip;
            $thread->views = $thread->views + 1;
            $thread->save();
        }

        return view('bitaac::forum.thread.show', [
            'thread' => $thread,
            'board'  => $board,
            'posts'  => $posts,
            'offset' => ($posts->currentPage() * $posts->perPage()) - $posts->perPage(),
        ]);
    }
}
