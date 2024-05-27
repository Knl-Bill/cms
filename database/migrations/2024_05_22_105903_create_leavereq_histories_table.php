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
        Schema::create('leavereq_histories', function (Blueprint $table) {
            $table->id();
            $table->string('rollno');
            $table->string('name');
            $table->string('phoneno');
            $table->string('placeofvisit');
            $table->string('purpose');
            $table->date('outdate');
            $table->time('outime');
            $table->date('indate');
            $table->time('intime');
            $table->string('noofdays');
            $table->integer('faculty_adv')->default(0);
            $table->integer('warden')->default(0);
            $table->string('image');
            $table->string('barcode');
            $table->string('status');
            $table->string('faculty_email');
            $table->string('warden_email');
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
        Schema::dropIfExists('leavereq_histories');
    }
};
