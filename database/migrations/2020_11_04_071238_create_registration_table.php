<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('bvn')->unique()->nullable();
            $table->unsignedBigInteger('user_code')->unique();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('marital_status')->nullable();
            $table->string('dependants')->nullable();
            $table->string('education')->nullable();
            $table->string('referee')->nullable();
            $table->integer('referal_code')->nullable();
            $table->string('resident_state')->nullable();
             $table->string('house_address')->nullable();
              $table->string('lga')->nullable();
               $table->string('id_card')->nullable();
                $table->string('info')->nullable();

               // next of kin

                $table->string('kin_phone')->nullable();
                 $table->string('fullname')->nullable();
                  $table->string('relationship')->nullable();
                     $table->string('kin_email')->nullable();

               // employer details

               $table->string('employers_name')->nullable();
               $table->date('employers_startdate')->nullable();
               $table->string('monthly_income')->nullable();
               $table->integer('employers_loan_repayment')->nullable();
               $table->integer('employers_loan_amount')->nullable();
               $table->string('employers_loan_tenure')->nullable();
               $table->string('employers_email')->unique()->nullable();
               $table->string('staff_id_card')->nullable();
               $table->string('employers_address')->nullable();
               $table->string('bank_statement')->nullable();

               // main loan details

                $table->integer('loan_amount')->nullable();
                $table->string('loan_tenure')->nullable();

                // ban k details

                $table->string('bank_name')->nullable();
                $table->string('bank_account_type')->nullable();
                $table->string('bank_account_number')->nullable();

                // statement 

                $table->string('ticket_id')->nullable();
                $table->string('password')->unique()->nullable();

                $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
