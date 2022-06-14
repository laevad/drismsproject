<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('fname')->default('unknown');
            $table->string('lname')->default('unknown');
            $table->string('username')->default('unknown');
            $table->string('email')->unique();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->date('dob')->nullable(); 
            $table->string('phone')->default('unknown');
            $table->string('address')->default('unknown');
            $table->string('password')->default('unknown'); 
            $table->string('token')->default('unknown');
            // $table->integer('school_id')->nullable();
            // $table->integer('branch_id')->nullable();
            // $table->integer('course_id')->nullable();
            $table->enum('role', ['Admin','Staff','Superadmin','Instructor','Student'])->default('Student');
            $table->string('positions')->default('unknown'); 
            $table->integer('enrollment_status')->nullable();
            $table->enum('status', ['Active', 'Suspended', 'Inactive'])->default('Active'); 
            $table->timestamp('email_verified_at')->nullable(); 
            $table->rememberToken();
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
        if (Schema::hasColumn('users'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('users');
            });
        }
       // Schema::dropIfExists('users');
    }
}
