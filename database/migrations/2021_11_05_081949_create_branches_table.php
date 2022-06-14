<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->integer('school_id')->nullable(); 
            $table->integer('postal_code')->nullable();
            $table->string('name')->default('unknown'); 
            $table->string('email')->unique();
            $table->string('address')->default('unknown'); 
            $table->string('phone')->default('unknown'); 
            $table->enum('type', ['Head Quarters', 'Branch'])->default('Head Quarters'); 
 
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
        Schema::dropIfExists('branches');
    }
}
