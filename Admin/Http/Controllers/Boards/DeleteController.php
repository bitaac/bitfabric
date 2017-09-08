<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\Forum\Board;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
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
     * Show the delete forum board page.
     *
     * @param  \Bitaac\Contracts\Forum\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function form(Board $board)
    {
        return view('admin::boards.delete')->with([
            'board' => $board,
        ]);
    }

    /**
     * Handle the delete forum board request.
     *
     * @param  \Bitaac\Forum\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function post(Board $board)
    {
        $board->delete();

        return redirect()->route('admin.boards')->with([
            'success' => 'Your board has been deleted.',
        ]);
    }
}
