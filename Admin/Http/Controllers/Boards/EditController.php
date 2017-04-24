<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\ForumBoard;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Boards\EditRequest;

class EditController extends Controller
{
    /**
     * Show edit forum board form to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(ForumBoard $board)
    {
        return view('admin::boards.edit')->with(compact('board'));
    }

    /**
     * Handle create forum board request.
     *
     * @param  \Bitaac\Admin\Http\Requests\Boards\EditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(EditRequest $request, ForumBoard $board)
    {
        $board->title = $request->get('title');
        $board->order = ($request->has('order')) ? $request->get('order') : 0;
        $board->description = $request->get('description');
        $board->save();

        return redirect('/admin/boards')->withSuccess('Your changes were saved.');
    }
}
