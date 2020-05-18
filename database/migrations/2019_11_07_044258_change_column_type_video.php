<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dj_videos', function (Blueprint $table) {
            $table->integer('maingenres')->nullable()->change();
            $table->string('brightcove_id')->nullable()->change();
            $table->mediumText('description')->nullable()->change();
            $table->string('keywords')->nullable()->change();
            $table->text('file')->nullable()->change();
            $table->string('convert_file')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->string('prive_type')->nullable()->change();
            $table->string('featuredartist')->nullable()->change();
            $table->string('director')->nullable()->change();
            $table->string('producer')->nullable()->change();
            $table->string('recordlabel')->nullable()->change();
            $table->string('copyright')->nullable()->change();
            $table->string('videotype')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('videourl')->nullable()->change();
            $table->string('song_download')->nullable()->change();
            $table->string('ring_download')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dj_videos', function (Blueprint $table) {
            //
        });
    }
}
