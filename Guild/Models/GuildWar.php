<?php

namespace Bitaac\Guild\Models;

use Bitaac\Contracts\Guild;
use Bitaac\Guild\Models\GuildWarKill;
use Bitaac\Core\Database\Eloquent\Model;

class GuildWar extends Model
{
    /**
     * Tell the model what table to use.
     *
     * @var string
     */
    protected $table = 'guild_wars';

    /**
     * Turn off timestamps for model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get all war kills.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kills()
    {
        return $this->hasMany(GuildWarKill::class, 'warid');
    }

    /**
     * Get the aggressor guild.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getAggressorGuild()
    {
        return $this->hasOne(Guild::class, 'id', 'guild1');
    }

    /**
     * Get the defender guild.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getDefenderGuild()
    {
        return $this->hasOne(Guild::class, 'id', 'guild2');
    }

    /**
     * Get the aggressor object.
     *
     * @return object
     */
    public function getAggressorAttribute()
    {
        $guild = $this->getAggressorGuild;

        return (object) [
            'guild' => $guild,
            'kills' => $this->kills->filter(function ($kill) use ($guild) {
                return $kill->killerguild == $guild->id;
            }),
        ];
    }

    /**
     * Get the defender object.
     *
     * @return object
     */
    public function getDefenderAttribute()
    {
        $guild = $this->getDefenderGuild;

        return (object) [
            'guild' => $guild,
            'kills' => $this->kills->filter(function ($kill) use ($guild) {
                return $kill->killerguild == $guild->id;
            }),
        ];
    }

    /**
     * Determine if war status is pending.
     *
     * @return boolean
     */
    public function isPending()
    {
        return $this->status == 0;
    }

    /**
     * Determine if war status is active.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * Determine if war status is cancelled.
     *
     * @return boolean
     */
    public function isCancelled()
    {
        return $this->status == 3;
    }
}
