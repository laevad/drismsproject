<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_schedules', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('instructor_id')->nullable(); 
            $table->integer('student_id')->nullable(); 
            $table->integer('school_id')->nullable(); 
            $table->integer('fleet_id')->nullable(); 
             
            $table->string('time_start_end')->default('unknown');

            $table->date('start')->nullable(); 
            $table->date('end')->nullable(); 
            
            $table->string('day')->default('unknown');  
            $table->integer('duration')->nullable();   
            $table->string('period')->default('unknown'); 
            
            $table->enum('status', ['completed', 'inprogress'])->default('inprogress');
            $table->enum('evaluation', ['pass', 'failed', 'pending'])->default('pending');
            $table->string('driver_license_no')->default('pending');
            $table->string('control_no')->default('pending');
            $table->string('date_issue')->default('pending');
            
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
        Schema::dropIfExists('fleet_schedules');
    }
}
