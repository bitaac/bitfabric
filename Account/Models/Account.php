<?php

namespace Bitaac\Account\Models;

use Carbon\Carbon;
use Bitaac\Traits\Authenticatable;
use Bitaac\Core\Database\Eloquent\Model;
use Bitaac\Contracts\Account as Contract;

class Account extends Model implements Contract
{
    use Authenticatable;

    /**
     * Table used by the model.
     */
    protected $table = 'accounts';

    /**
     * Tell the model to not use timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Retrive the accounts birthday.
     *
     * @return int
     */
    public function birthday()
    {
        return ($this->creation) ? $this->creation : strtotime($this->bit->created_at);
    }

    /**
     * Determinate if account has pending change email.
     *
     * @return bool
     */
    public function hasPendingEmail()
    {
        return (bool) $this->bit->email_change_new;
    }

    /**
     * Get the pending email.
     *
     * @return string
     */
    public function getPendingEmail()
    {
        return (string) $this->bit->email_change_new;
    }

    /**
     * Get the timestamp when pending email is gonna be updated.
     *
     * @return timestamp
     */
    public function getPendingEmailTime()
    {
        return Carbon::createFromTimestamp($this->bit->email_change_time);
    }

    /**
     * Update the email with the pending email.
     *
     * @return void
     */
    public function updateEmailWithPending()
    {
        $this->email = $this->getPendingEmail();
        $this->save();

        $this->bit->email_change_time = null;
        $this->bit->email_change_new = null;
        $this->bit->save();
    }

    /**
     * Return related BitaacAccount.
     *
     * @return Bitaac\Account\BitaacAccount
     */
    public function bit()
    {
        return $this->hasOne('Bitaac\Account\Models\BitaacAccount', 'account_id', 'id');
    }

    /**
     * return all related characters to the account.
     *
     * @return
     */
    public function characters()
    {
        return $this->hasMany('Bitaac\Contracts\Player', 'account_id', 'id');
    }

    /**
     * Determine if account is a admin account_id.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return (bool) $this->bit->admin;
    }

    /**
     * Get all characters that belongs to given guild.
     *
     * @return
     */
    public function getGuildCharacters($guild)
    {
        foreach ($guild->getMembers as $member) {
            if ($member->player->account_id == $this->id) {
                $characters[] = $member;
            }
        }

        return (isset($characters)) ? $characters : false;
    }

    /**
     * Get all characters that belongs to given guild expect owner.
     *
     * @return
     */
    public function getGuildCharactersExpectOwner($guild)
    {
        foreach ($guild->getMembersExceptOwner as $member) {
            if ($member->player->account_id == $this->id and $member->player->id != $this->ownerid) {
                $characters[] = $member;
            }
        }

        return (isset($characters)) ? $characters : false;
    }

    /**
     * Determine if any character on account has invite to guild.
     *
     * @param  \Bitaac\Guild\Contracts\Guild  $Guild
     * @return bool
     */
    public function hasGuildInvite($guild)
    {
        foreach ($guild->getInvites as $invite) {
            if ($invite->player->account_id == $this->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if any character on account is vice-leader for guild.
     *
     * @param \Bitaac\Guild\Contracts\Guild  $Guild
     * @return bool
     */
    public function hasViceLeader($guild)
    {
        foreach ($guild->getViceLeaders as $leader) {
            if ($leader->player->account_id == $this->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if any character on account is leader for guild.
     *
     * @param \Bitaac\Guild\Contracts\Guild  $Guild
     * @return bool
     */
    public function hasLeader($guild)
    {
        foreach ($guild->getLeaders as $leader) {
            if ($leader->player->account_id == $this->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if any character on account is owner for guild.
     *
     * @param \Bitaac\Guild\Contracts\Guild  $Guild
     * @return bool
     */
    public function hasOwner($guild)
    {
        foreach ($this->characters as $character) {
            if ($character->id == $guild->ownerid) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if any character on account is member of guild.
     *
     * @param \Bitaac\Guild\Contracts\Guild  $Guild
     * @return bool
     */
    public function hasMember($guild)
    {
        foreach ($guild->getAllMembers as $member) {
            if ($member->player->account_id == $this->id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Disable the remember token.
     *
     * @return void
     */
    public function getRememberToken()
    {
    }

    /**
     * Disable the remember token.
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        // not supported
    }

    /**
     * Disable the remember token.
     *
     * @return void
     */
    public function getRememberTokenName()
    {
    }
}
