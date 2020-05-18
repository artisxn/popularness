<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideoPlayListTableRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_playlists', function (Blueprint $table) {
            $table->unsignedBigInteger('play_list_id')->change();
            $table->unsignedBigInteger('video_id')->change();
            $table->index('play_list_id');
            $table->index('video_id');
            $table->foreign('play_list_id')->references('id')->on('user_play_lists')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('video_id')->references('id')->on('videos')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_playlists', function (Blueprint $table) {
            //
        });
    }
}
