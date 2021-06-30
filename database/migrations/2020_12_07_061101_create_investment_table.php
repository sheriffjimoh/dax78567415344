<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('investment_id')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('amount');
            $table->string('tenure');
            $table->string('interest');
            $table->string('status');
            $table->string('total');
            $table->string('rate');
            $table->string('payment_method');
             $table->string('file')->nullable();

            $table->foreign('user_id')->references('id')->on('users');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
}
