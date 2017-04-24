<?php

namespace Bitaac\Player\Resources\Seeds;

use Illuminate\Database\Seeder;
use Bitaac\Player\Models\BitaacPlayer;

class PlayerPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = app('player')->all();

        foreach ($players as $player) {
            if ($player->bitaac) {
                continue;
            }

            $bitplayer = new BitaacPlayer;
            $bitplayer->player_id = $player->id;
            $bitplayer->save();
        }
    }
}
