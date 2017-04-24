<?php

namespace Bitaac\Forum\Models;

use Bitaac\Contracts\ForumBoard;
use Bitaac\Core\Database\Eloquent\Model;

class Board extends Model implements ForumBoard
{
    /**
     * Table used by the model.
     *
     * @var string
     */
    protected $table = '__bitaac_forum_boards';

    /**
     * Retrive all threads that belongs to board.
     *
     * @return \Illuminate\Database\Relations
     */
    public function threads()
    {
        return $this->hasMany('Bitaac\Contracts\ForumPost', 'board_id')->where('belongs_to', 0)->orderBy('timestamp', 'desc');
    }

    /**
     * Retrive board latest post info.
     *
     * @return \Bitaac\Forum\Models\ForumPost
     */
    public function latest()
    {
        return $this->hasMany('Bitaac\Contracts\ForumPost', 'board_id')->orderBy('created_at', 'desc')->first();
    }

    /**
     * Create a link to the board.
     *
     * @return string
     */
    public function link()
    {
        return url_e('/forum/:board', [
            'board' => $this->title,
        ]);
    }

    /**
     * Retrive all replies that belongs to board.
     *
     * @return \Illuminate\Database\Relations
     */
    public function replies()
    {
        return $this->hasMany('Bitaac\Contracts\ForumPost', 'board_id')->where('belongs_to', '>', 0);
    }
}
