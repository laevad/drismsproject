<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->integer('student_id')->nullable();
            $table->integer('instructor_id')->nullable();
            $table->integer('fleet_schedule_id')->nullable();
            $table->integer('student_course_id')->nullable();
            $table->enum('classes', ['theoretical', 'practical'])->default('theoretical');
            
            $table->integer('demonstrates_sensivity_to_students')->nullable(); 
            $table->integer('keeps_accurate_records_of_students')->nullable(); 
            $table->integer('demonstrates_mastery_subject_matter')->nullable(); 

            $table->integer('creates_teaching_strategies')->nullable(); 
            $table->integer('enhances_student_self_esteem')->nullable(); 
            $table->integer('encourage_students')->nullable(); 
            $table->integer('designs_and_implements_learning_conditions')->nullable(); 
            $table->longText('comments')->default('unknown'); 
            $table->string('allow_comment_use')->default('unknown'); 

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
        Schema::dropIfExists('evaluation');
    }
}
