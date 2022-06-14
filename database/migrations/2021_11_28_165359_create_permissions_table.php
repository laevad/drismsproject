<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('staff_id')->nullable();
            $table->string('scheduling')->default('read_only');
            $table->string('students')->default('read_only');
            $table->string('instructor')->default('read_only');
            $table->string('fleet')->default('read_only');
            $table->string('branch')->default('read_only');
            $table->string('invoice')->default('read_only');
            $table->string('course')->default('read_only');
            $table->string('school')->default('read_only'); 
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
        Schema::dropIfExists('permissions');
    }
}
