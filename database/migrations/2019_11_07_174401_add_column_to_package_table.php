<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('name',150)->unique()->change();
            $table->unsignedDecimal('price',8,2);
            $table->unsignedTinyInteger('monthly_upload')->comment(' How many Video upload in per month');
            $table->unsignedDecimal('total_storage',8,2)->comment('Total video upload storage size');
            $table->unsignedTinyInteger('analytics')->comment('0 = false, 1 = true')->default(0);
            $table->unsignedTinyInteger('report_enable')->default(0);
            $table->unsignedTinyInteger('chart_option')->default(0);
            $table->unsignedTinyInteger('video_monetize')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}
