<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transacts', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('available_balance')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('amount');
            $table->string('transaction_type');
            $table->string('investor_id')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transacts', function (Blueprint $table) {
            //
        });
    }
}
