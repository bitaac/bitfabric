<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    /**
     * Show the faq page to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bitaac::community.faq');
    }
}
