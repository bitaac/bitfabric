<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\ForumBoard;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    /**
     * Show delete forum board form to user.
     *
     * @param  \Bitaac\Forum\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function form(ForumBoard $board)
    {
        return view('admin::boards.delete')->with(compact('board'));
    }

    /**
     * Handle create forum board request.
     *
     * @param  \Bitaac\Forum\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function post(ForumBoard $board)
    {
        $board->delete();

        return redirect('/admin/boards')->withSuccess('Your board has been deleted.');
    }
}
