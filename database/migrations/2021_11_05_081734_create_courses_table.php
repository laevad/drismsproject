<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('school_id')->nullable(); 
            // $table->integer('branch_id')->nullable(); 
            // $table->integer('practical_classes')->nullable(); 
            // $table->integer('theory_classes')->nullable(); 

            // $table->integer('duration')->nullable();  
            $table->float('price')->nullable(); 
            $table->string('name')->default('unknown');  
           // $table->string('period')->default('unknown'); 
            $table->enum('status', ['Available', 'Unavailable'])->default('Available');   
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
        Schema::dropIfExists('courses');
    }
}
