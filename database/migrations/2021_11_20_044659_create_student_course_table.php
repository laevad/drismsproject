<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('school_course_id')->nullable();


            $table->integer('student_id')->nullable();
            $table->integer('school_id')->nullable();
            $table->integer('branch_id')->nullable();
            
            $table->string('driving_lto_requirement')->nullable();
            $table->string('theoretical_driving_course')->nullable();
            $table->string('practical_driving_course_mv')->nullable();
            $table->string('manual_transmission_mv')->nullable();
            $table->string('automatic_transmission_mv')->nullable();
            $table->string('practical_driving_course_mc')->nullable();
            $table->string('manual_transmission_mc')->nullable();
            $table->string('automatic_transmission_mc')->nullable();
            $table->string('others_mc')->nullable();
            $table->string('where_did_you_know_school_')->nullable();


            $table->string('civil_status')->nullable();
            $table->string('pob')->nullable();
            $table->string('height')->nullable();
            $table->string('weigth')->nullable();
            $table->string('blood_type')->nullable();

            $table->string('name_of_mother')->nullable();
            $table->string('name_of_father')->nullable();
            $table->string('person_notify_in_case_of_emergency')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_number')->nullable();
            $table->string('guardian_pob')->nullable();
            $table->string('guardian_relation')->nullable();


            $table->string('y_e')->default('more than a months');

            $table->string('orno')->nullable();
            $table->string('amount_paid')->nullable();
            
            $table->enum('status', ['completed', 'inprogress'])->default('inprogress');

            $table->enum('evaluation', ['pass', 'failed', 'pending'])->default('pending');

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
        Schema::dropIfExists('student_course');
    }
}
