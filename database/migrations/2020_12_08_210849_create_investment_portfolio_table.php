<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentPortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_portfolios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
             $table->string('investment_id')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('amount');
            $table->string('total_interest');
            $table->string('monthly_payment');
             $table->string('total_repayment');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('status');
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
        Schema::dropIfExists('investment_portfolios');
    }
}
