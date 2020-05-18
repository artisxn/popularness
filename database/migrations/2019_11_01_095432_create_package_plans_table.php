<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_plans', function (Blueprint $table) {
            $table->smallIncrements('id')->unsigned();
            $table->unsignedSmallInteger('package_id')->comment('Package Table primary Id');
            $table->foreign('package_id')->references('id')
                ->on('packages')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedDecimal('price',8,2);
            $table->unsignedTinyInteger('monthly_upload')->comment(' How many Video upload in per month');
            $table->unsignedDecimal('total_storage',8,2)->comment('Total video upload storage size');
            $table->unsignedTinyInteger('analytics')->comment('0 = false, 1 = true')->default(0);
            $table->unsignedTinyInteger('report_enable')->default(0);
            $table->unsignedTinyInteger('chart_option')->default(0);
            $table->unsignedTinyInteger('video_monetize')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('package_plans');
    }
}
