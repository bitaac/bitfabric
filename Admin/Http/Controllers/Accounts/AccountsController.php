<?php

namespace Bitaac\Admin\Http\Controllers\Accounts;

use Bitaac\Contracts\Account;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
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
     * Show the admin accounts page.
     *
     * @param  \Bitaac\Contracts\Account  $product
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        return view('admin::accounts.index')->with([
            'accounts' => $account->all(),
        ]);
    }
}
