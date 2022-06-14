<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->integer('image_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('school_id')->nullable();
            $table->integer('branch_id')->nullable(); 
            $table->enum('status', ['active', 'not active'])->default('active');
            $table->enum('type', ['newaccount', 'payment', 'delete', 'message', 'calendar'])->default('newaccount');
            $table->enum('class', ['personal', 'school', 'branch', 'system'])->default('personal');
            $table->string('message')->default('unknown');
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
        Schema::dropIfExists('notifications');
    }
}
