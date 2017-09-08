<?php

namespace Bitaac\Admin\Http\Controllers\Account;

use Illuminate\Http\Request;
use Bitaac\Contracts\Account;
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
     * Show the delete account page.
     *
     * @param  \Bitaac\Contracts\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function form(Account $account)
    {
        return view('admin::account.delete')->with([
            'editAccount' => $account,
        ]);
    }

    /**
     * Handle the delete account request.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \Bitaac\Contracts\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, Account $account)
    {
        if ($request->has('characters')) {
            $account->characters()->delete();
        }

        $account->delete();

        return redirect()->route('admin.accounts')->with([
            'success' => 'Account has been deleted.',
        ]);
    }
}
