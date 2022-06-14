<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesenrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_enrolled', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('school_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('total_theory')->nullable();
            $table->integer('total_practical')->nullable();
            $table->integer('completed_theory')->nullable();
            $table->integer('completed_practical')->nullable();
            $table->timestamp('completed_date')->useCurrent();
            $table->enum('status', ['Pending', 'Complete'])->default('Pending'); 
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
        Schema::dropIfExists('coursesenrolled');
    }
}
