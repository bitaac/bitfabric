<?php

namespace Bitaac\Player\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Show the character search form to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('bitaac::character.search');
    }

    /**
     * Search for a character.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|exists:players,name',
        ]);

        return redirect(url_e('/character/:name', ['name' => $request->get('name')]));
    }
}
