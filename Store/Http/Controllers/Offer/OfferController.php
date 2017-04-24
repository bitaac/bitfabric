<?php

namespace Bitaac\Store\Http\Controllers\Offer;

use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Show the offers to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bitaac::store.offers.index');
    }
}
