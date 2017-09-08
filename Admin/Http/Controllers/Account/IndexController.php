<?php

namespace Bitaac\Admin\Http\Controllers\Account;

use Illuminate\Http\Request;
use Bitaac\Contracts\Account;
use App\Http\Controllers\Controller;

class IndexController extends Controller
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
     * Show the account page.
     *
     * @param  \Bitaac\Contracts\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        return view('admin::account.index')->with([
            'editAccount' => $account,
        ]);
    }

    /**
     * Handle the quick edit account request.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \Bitaac\Contracts\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, Account $account)
    {
        if (! $request->has('admin')) {
            $request->merge(['admin' => false]);
        }

        $account->bitaac->update($request->only([
            'points', 'admin'
        ]));

        return back()->with([
            'success' => 'Your changes has been saved.',
        ]);
    }
}
