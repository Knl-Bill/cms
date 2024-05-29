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
        Schema::create('leavehistory', function (Blueprint $table) {
            $table->id();
            $table->string('rollno');
            $table->string('name');
            $table->string('phoneno');
            $table->string('placeofvisit');
            $table->string('purpose');
            $table->dateTime('outtime');
            $table->dateTime('intime')->nullable();
            $table->string('outregistration');
            $table->string('outgate');
            $table->string('inregistration')->nullable();
            $table->string('ingate')->nullable();
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
        //
        Schema::dropIfExists('leavehistory');
    }
};
