<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\Forum\Board;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Boards\EditRequest;

class EditController extends Controller
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
     * Show the edit forum board page.
     *
     * @param  \Bitaac\Contracts\Forum\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function form(Board $board)
    {
        return view('admin::boards.edit')->with([
            'board' => $board,
        ]);
    }

    /**
     * Handle the edit forum board request.
     *
     * @param  \Bitaac\Admin\Http\Requests\Boards\EditRequest  $request
     * @param  \Bitaac\Contracts\Forum\Board                    $board
     * @return \Illuminate\Http\Response
     */
    public function post(EditRequest $request, Board $board)
    {
        $board->update($request->only([
            'title', 'order', 'description'
        ]));

        return redirect()->route('admin.boards')->with([
            'success' => 'Your changes were saved.',
        ]);
    }
}
