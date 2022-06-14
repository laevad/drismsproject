<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('unknown');
            $table->string('email')->unique();
            $table->string('phone')->default('unknown');
            $table->string('address')->default('unknown');
            $table->string('currency')->default('unknown');
            $table->string('timezone')->default('unknown');
            $table->enum('status', ['Active', 'Suspended'])->default('Active');
            $table->enum('payment_reminder', ['On', 'Off'])->default('On');
            $table->enum('class_reminder', ['On', 'Off'])->default('On');
            $table->enum('multi_booking', ['Enabled', 'Disabled'])->default('Enabled');
            $table->enum('class_sms_notification', ['Enabled', 'Disabled'])->default('Enabled');
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
        Schema::dropIfExists('schools');
    }
}
