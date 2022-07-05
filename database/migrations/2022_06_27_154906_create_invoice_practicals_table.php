<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePracticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_practicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('reference')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('course_name')->nullable();
            // $table->integer('school_id')->nullable();
            // $table->integer('branch_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->float('amount')->nullable();
            $table->string('method')->nullable();
            //$table->string('item')->default('unknown');
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
        Schema::dropIfExists('invoice_practicals');
    }
}
