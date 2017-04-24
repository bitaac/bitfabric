<?php

namespace Bitaac\Forum\Http\Controllers\Thread;

use Bitaac\Forum\Models\Board;
use Bitaac\Forum\Models\ForumPost;
use App\Http\Controllers\Controller;
use Bitaac\Forum\Http\Requests\Thread\CreateRequest;

class CreateController extends Controller
{
    /**
     * Show the create a new thread form to the user.
     *
     * @param  string  $board
     * @return \Illuminate\Http\Response
     */
    public function form($board)
    {
        return view('bitaac::forum.thread.create', [
            'board' => $board,
        ]);
    }

    /**
     * Process the thread creation.
     *
     * @param  string  $board
     * @return \Illuminate\Http\Response
     */
    public function post(CreateRequest $request, $board)
    {
        $exists = ForumPost::where('title', $title = trim($request->get('title')));

        if ($exists->exists()) {
            $number = 0;
            $proceed = false;
            while ($proceed == false) {
                $number = $number + 1;
                $title = $exists->first()->title.' '.$number;

                if (! ForumPost::where('title', $title)->exists()) {
                    $proceed = true;
                }
            }
        }

        $post = new ForumPost;
        $post->board_id = $board->id;
        $post->player_id = $request->get('author');
        $post->title = $title;
        $post->content = $request->get('content');
        $post->timestamp = time();
        $post->save();

        return redirect(url_e('/forum/:board/:title', [
            'board' => $board->title,
            'title' => $post->title,
        ]));
    }
}
