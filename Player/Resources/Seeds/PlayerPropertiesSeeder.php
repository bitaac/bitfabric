<?php

namespace Bitaac\Player\Resources\Seeds;

use Illuminate\Database\Seeder;
use Bitaac\Player\Models\BitPlayer;

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
            if ($player->bit) {
                continue;
            }

            $bitplayer = new BitPlayer;
            $bitplayer->player_id = $player->id;
            $bitplayer->save();
        }
    }
}
