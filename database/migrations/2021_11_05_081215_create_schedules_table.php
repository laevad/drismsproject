<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('school_id')->nulllable();
            $table->integer('branch_id')->nullable(); 
            $table->integer('student_id')->nullable(); 
            $table->integer('instructor_id')->nullable(); 
            $table->integer('course_id')->nullable(); 
            $table->integer('fleet_id')->nullable(); 
            $table->string('start')->default('unknown'); 
            $table->string('end')->default('unknown'); 
            $table->enum('class_type', ['Practical', 'Theory'])->default('Practical');  
            $table->enum('status', ['New', 'Completed', 'Missed'])->default('Completed');  
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
        Schema::dropIfExists('schedules');
    }
}
