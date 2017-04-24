<?php

namespace Bitaac\Player\Models;

use Bitaac\Core\Database\Eloquent\Model;

class BitaacPlayer extends Model
{
    /**
     * Table used by the model.
     */
    protected $table = '__bitaac_players';

    /**
     * Get the players related row from players.
     *
     * @return \Player\Player
     */
    public function player()
    {
        return $this->hasOne('Bitaac\Contracts\Player', 'id', 'player_id');
    }
}
