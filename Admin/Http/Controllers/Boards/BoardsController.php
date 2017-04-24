<?php

namespace Bitaac\Admin\Http\Controllers\Boards;

use Bitaac\Contracts\ForumBoard;
use App\Http\Controllers\Controller;

class BoardsController extends Controller
{
    /**
     * Show all forum boards to user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ForumBoard $boards)
    {
        return view('admin::boards.index')->with([
            'boards' => $boards->get(),
        ]);
    }
}

