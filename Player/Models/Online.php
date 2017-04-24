<?php

namespace Bitaac\Player\Models;

use Bitaac\Core\Database\Eloquent\Model;
use Bitaac\Contracts\Online as Contract;

class Online extends Model implements Contract
{
    /**
     * Table used by the model.
     */
    protected $table = 'players_online';

    /**
     * Tell the model to not use timestamps.
     *
     * @var bool
     */
    public $timestamps = false;
}
