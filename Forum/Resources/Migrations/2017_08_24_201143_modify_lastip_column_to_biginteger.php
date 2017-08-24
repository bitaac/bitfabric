<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLastipColumnToBiginteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('__bitaac_forum_posts', function (Blueprint $table) {
            $table->bigInteger('lastip')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('__bitaac_forum_posts', function (Blueprint $table) {
            $table->integer('lastip')->change();
        });
    }
}
