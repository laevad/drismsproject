<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_course', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('instructor_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('school_id')->nullable(); 
             
            $table->string('time_start_end')->default('unknown');

            $table->date('start')->nullable(); 
            $table->date('end')->nullable(); 
            
            $table->integer('duration')->nullable();  
            $table->string('period')->default('unknown'); 

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
        Schema::dropIfExists('school_course');
    }
}
