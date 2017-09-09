<?php

namespace Bitaac\Death\Models;

use Bitaac\Contracts\Player;
use Bitaac\Contracts\Death as Contract;
use Bitaac\Core\Database\Eloquent\Model;

class Death extends Model implements Contract
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'player_deaths';

    /**
     * Get the related player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function player()
    {
        return $this->hasOne(Player::class, 'id', 'player_id');
    }

    /**
     * Get the killer player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function killer()
    {
        return $this->hasOne(Player::class, 'name', 'killed_by');
    }

    /**
     * Get the most damage player.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mostDamagePlayer()
    {
        return $this->hasOne(Player::class, 'name', 'mostdamage_by');
    }
}
