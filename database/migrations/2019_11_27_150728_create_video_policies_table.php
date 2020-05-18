<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_policies', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->decimal('min_amount',6,2)->unsigned()->comment('Min amount for donate against a video once time');
            $table->decimal('max_amount',6,2)->unsigned()->comment('Max amount for donate against a video once time');
            $table->decimal('total_amount',6,2)->unsigned()->comment('Total amount donate against a video for a single account ');
            $table->smallInteger('max_transaction')->unsigned()->comment('Limit for transaction in a single video ');
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
        Schema::dropIfExists('video_policies');
    }
}
