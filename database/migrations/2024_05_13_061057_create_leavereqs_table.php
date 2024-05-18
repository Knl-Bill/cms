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
        Schema::create('leavereqs', function (Blueprint $table) {
            $table->id();
            $table->string('rollno')->unique();
            $table->string('name');
            $table->string('phoneno')->unique();
            $table->string('placeofvisit');
            $table->string('purpose');
            $table->date('outdate');
            $table->time('outime');
            $table->date('indate');
            $table->time('intime');
            $table->string('noofdays');
            $table->string('image');
            $table->integer('faculty_adv')->default(0);
            $table->integer('warden')->default(0);
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
        Schema::dropIfExists('leavereqs');
    }
};
