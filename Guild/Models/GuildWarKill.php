<?php

namespace Bitaac\Guild\Models;

use Bitaac\Core\Database\Eloquent\Model;

class GuildWarKill extends Model
{
    /**
     * Tell the model what table to use.
     *
     * @var string
     */
    protected $table = 'guildwar_kills';

    /**
     * Turn off timestamps for model.
     *
     * @var bool
     */
    public $timestamps = false;
}
