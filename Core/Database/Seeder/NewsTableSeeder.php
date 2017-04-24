<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('__bitaac_forum_boards')->insert([
            'title'       => 'Latest News',
            'description' => 'Here you\'ll find all of our latest announcements.',
            'news'        => 1,
        ]);
    }
}
