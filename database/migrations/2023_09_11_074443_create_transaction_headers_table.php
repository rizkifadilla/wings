<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->string('transactionId', 10)->primary();
            $table->string('documentCode', 3);
            $table->string('documentNumber', 10);
            $table->bigInteger('userId')->unsigned();
            $table->string('status', 10);
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // $table->dropForeign('lists_user_foreign');
        // $table->dropIndex('lists_user_index');
        // $table->dropColumn('user');
        Schema::dropIfExists('transaction_headers');
    }
}
