<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;

class TermsController extends Controller
{
    /**
     * [GET] /terms
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        return view('bitaac::community.terms');
    }
}
