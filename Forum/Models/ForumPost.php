<?php

namespace Bitaac\Forum\Models;

use Bitaac\Core\Database\Eloquent\Model;
use Bitaac\Contracts\ForumPost as Contract;

class ForumPost extends Model implements Contract
{
    protected $table = '__bitaac_forum_posts';

    public function player()
    {
        return $this->hasOne('Bitaac\Player\Models\Player', 'id', 'player_id');
    }

    public function board()
    {
        return $this->hasOne('Bitaac\Forum\Models\Board', 'id', 'board_id');
    }

    public function lock()
    {
        $this->locked = 1;
        $this->save();
    }

    public function unlock()
    {
        $this->locked = 0;
        $this->save();
    }

    public function replies()
    {
        return $this->hasMany('Bitaac\Forum\Models\ForumPost', 'belongs_to')->join('players', function ($join) {
            $join->on('__bitaac_forum_posts.player_id', '=', 'players.id');
        })->select([
            '__bitaac_forum_posts.id', 'players.name AS player_name', 'content', 'timestamp', 'player_id', 'created_at', 'board_id',
        ]);
    }

    public function link()
    {
        return url_e('/forum/:board/:thread', [
            'board'  => $this->board->title,
            'thread' => $this->title,
        ]);
    }

    public function hotlink($thread, $reply)
    {
        return url_e('/forum/:board/:thread#:reply', [
            'board'  => $this->board->title,
            'thread' => $thread->title,
            'reply'  => $reply,
        ]);
    }

    public function deleteReplies()
    {
        $posts = $this->where('belongs_to', $this->id)->delete();
    }
}
