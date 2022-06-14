<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            // $table->integer('instructor_id')->nullable();
            // $table->integer('school_id')->nullable();
            // $table->integer('branch_id')->nullable(); 


            $table->string('car_no')->default('unknown');
            $table->string('car_plate')->default('unknown');
            $table->string('make')->default('unknown');
            $table->string('model')->default('unknown');
            $table->string('model_year')->default('unknown');
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
        Schema::dropIfExists('fleet');
    }
}
