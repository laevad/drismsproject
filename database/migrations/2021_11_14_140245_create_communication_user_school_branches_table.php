<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationUserSchoolBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communication_user_school_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_sender_id')->nullable();
            $table->integer('comm_id')->nullable();
            $table->integer('user_receiver_id')->nullable();
            $table->integer('school_receiver_id')->nullable();
            $table->integer('branch_receiver_id')->nullable(); 
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
        Schema::dropIfExists('communication_user_school_branches');
    }
}
