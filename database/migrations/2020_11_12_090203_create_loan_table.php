<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('loans', function (Blueprint $table) {
             $table->id();
            $table->string('loan_id')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('loan_amount');
            $table->string('loan_tenure');
            $table->string('mandate_id')->unique()->nullable();
            $table->string('status')->nullable();
            $table->string('loan_repayment_amount')->nullable();
            $table->string('loan_doc')->nullable();
             $table->string('remark')->nullable();
               $table->string('customer_reply')->nullable();
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
        Schema::dropIfExists('loans', function (Blueprint $table) {
            //
        });
    }
}
