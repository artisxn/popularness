<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('primary_genre')->default('0');
            $table->integer('package_id')->default('1');
            $table->integer('user_type')->default('1');
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->date('dob')->nullable();
            $table->string('image')->nullable();
            $table->integer('gender')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('=users', function (Blueprint $table) {
            //
        });
    }
}
