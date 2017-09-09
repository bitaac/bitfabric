<?php

namespace Bitaac\Community\Http\Controllers;

use App\Http\Controllers\Controller;
use Bitaac\Community\Http\Responses\DeathsResponse;

class DeathsController extends Controller
{
    /**
     * Show the latest deaths page.
     *
     * @return \Bitaac\Community\Http\Responses\DeathsResponse
     */
    public function index()
    {
        return new DeathsResponse();
    }
}
