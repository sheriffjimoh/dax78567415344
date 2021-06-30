<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->id();
            $table->string('loan_id')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('repayment_amount');
            $table->string('total_repayment');
            $table->string('mandate_id')->unique();
            $table->string('loan_tenure');
            $table->string('status');
            $table->date('repayment_date');
            $table->timestamps();

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
        Schema::dropIfExists('loan_repayments');
    }
}
