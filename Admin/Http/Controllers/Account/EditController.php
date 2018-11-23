<?php

namespace Bitaac\Admin\Http\Controllers\Account;

use Bitaac\Contracts\Account;
use App\Http\Controllers\Controller;
use Bitaac\Admin\Http\Requests\Accounts\EditRequest;

class EditController extends Controller
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
     * Show the account edit page.
     *
     * @param  \Bitaac\Contracts\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function form(Account $account)
    {
        return view('admin::account.edit')->with([
            'account' => $account,
        ]);
    }

    /**
     * Handle the account edit request.
     *
     * @param  \Bitaac\Admin\Http\Requests\Accounts\EditRequest  $request
     * @param  \Bitaac\Contracts\Account                         $account
     * @return \Illuminate\Http\Response
     */
    public function post(EditRequest $request, Account $account)
    {
        $account->update($request->only([
            'name', 'secret', 'type', 'premdays', 'lastday', 'email'
        ]));

        return back()->with([
            'success' => 'Your changes has been saved.',
            'editAccount' => $account,
        ]);
    }
}
