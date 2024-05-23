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
        //
        Schema::create('outing__table', function (Blueprint $table) {
            $table->id();
            $table->string('rollno');
            $table->string('name');
            $table->string('phoneno');
            $table->string('email');
            $table->string('year');
            $table->string('gender');
            $table->string('hostel');
            $table->string('roomno');
            $table->dateTime('outtime');
            $table->dateTime('intime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outing__table');
        //
    }
};
