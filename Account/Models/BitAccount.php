<?php

namespace Bitaac\Account\Models;

use Google2FA;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BitAccount extends Model
{
    /**
     * Table used by the model.
     */
    protected $table = '__bitaac_accounts';

    /**
     * Renew the last_login value.
     *
     * @return void
     */
    public function updateLastLogin()
    {
        $this->last_login = Carbon::now()->toDateTimeString();
        $this->save();
    }

    /**
     * Generate a Two Factor Authentication secret to account.
     *
     * @return void
     */
    public function generateSecret()
    {
        $this->secret = Google2FA::generateSecretKey();
        $this->save();
    }
}
