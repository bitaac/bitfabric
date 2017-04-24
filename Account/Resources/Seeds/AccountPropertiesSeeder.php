<?php

namespace Bitaac\Account\Resources\Seeds;

use Illuminate\Database\Seeder;
use Bitaac\Account\Models\BitaacAccount;

class AccountPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = app('account')->all();

        foreach ($accounts as $account) {
            if ($account->bitaac) {
                continue;
            }

            $bitaccounts = new BitaacAccount;
            $bitaccounts->account_id = $account->id;
            $bitaccounts->save();
        }
    }
}
