<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedTinyInteger('wallet_type')->comment('1 = Deposit Balance, 2 = Earning Balance')->index();
            $table->unsignedBigInteger('wallet_id')->comment('wallets table primary id')->index();
            $table->decimal('amount',8,2)->comment('transaction amount');
            $table->unsignedBigInteger('product_id')->index()->nullable();
            $table->unsignedTinyInteger('opt_type')->comment('1 = deposit, 2 = donate, 3 = earning, 4= withdrawal,5 = transfer');
            $table->unsignedTinyInteger('type');
            $table->tinyInteger('confirmed')->default('1');
            $table->json('meta')->comment('meta data');
            $table->timestamps();
            $table->foreign('wallet_id')->references('id')
                ->on('wallets')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
