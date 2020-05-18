<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDjVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('dj_videos', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('brightcove_id')->default(0);
            $table->string('title');
            $table->mediumText('description');
            $table->string('keywords');
            $table->integer('user_id');
            $table->text('file');
            $table->string('convert_file');
            $table->string('image');
            $table->tinyInteger('status');
            $table->tinyInteger('prive')->default(0);
            $table->string('prive_type');
            $table->string('artistname');
            $table->string('featuredartist');
            $table->string('director');
            $table->string('producer');
            $table->string('recordlabel');
            $table->string('copyright');
            $table->string('videotype');
            $table->string('genres');
            $table->integer('maingenres');
            $table->string('email');
            $table->string('videourl')->nullable();
            $table->string('song_download');
            $table->string('ring_download');
            $table->bigInteger('views');
            $table->string('modifyDate')->nullable();
            $table->text('wistia')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dj_videos');
    }
}
