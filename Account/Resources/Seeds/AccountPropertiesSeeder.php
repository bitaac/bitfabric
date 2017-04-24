<?php

namespace Bitaac\Account\Resources\Seeds;

use Illuminate\Database\Seeder;
use Bitaac\Account\Models\BitAccount;

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
            if ($account->bit) {
                continue;
            }

            $bitaccounts = new BitAccount;
            $bitaccounts->account_id = $account->id;
            $bitaccounts->save();
        }
    }
}
