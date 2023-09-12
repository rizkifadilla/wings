<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->string('transactionId', 10);
            $table->string('productCode', 18);
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('transactionId')->references('transactionId')->on('transaction_headers')->onDelete('cascade');
            $table->foreign('productCode')->references('productCode')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
