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
        Schema::create('admin_logins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phoneno')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('department');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_logins');
    }
};
