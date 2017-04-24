<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;
use Bitaac\Forum\Models\Board;

class WelcomeController extends Controller
{
    /**
     * Show the index page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Board::where('news', 1)->first();

        return view('bitaac::home.index', compact('news'));
    }
}
