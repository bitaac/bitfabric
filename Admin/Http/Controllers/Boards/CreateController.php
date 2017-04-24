<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\ForumBoard;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Boards\CreateRequest;

class CreateController extends Controller
{
    /**
     * Show create board form to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('admin::boards.create');
    }

    /**
     * Handle create forum board request.
     *
     * @param  \Bitaac\Admin\Http\Requests\Boards\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function post(CreateRequest $request, ForumBoard $board)
    {
        $board = new $board;
        $board->title = $request->get('title');
        $board->order = ($request->has('order')) ? $request->get('order') : 0;
        $board->description = $request->get('description');
        $board->save();

        return redirect('/admin/boards')->withSuccess('Your board has been created.');
    }
}
