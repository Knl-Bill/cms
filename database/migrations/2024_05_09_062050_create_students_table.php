<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('rollno')->unique();
            $table->string('name');
            $table->string('phoneno')->unique();
            $table->string('email')->unique();
            $table->string('course');
            $table->string('batch');
            $table->string('dept');
            $table->string('gender');
            $table->string('hostelname');
            $table->string('roomno');
            $table->string('faculty_advisor');
            $table->string('warden'); 
            $table->string('password');
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
        Schema::dropIfExists('students');
    }
};
