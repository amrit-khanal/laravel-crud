<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email', 100);
            $table->string('name', 50);
            $table->string('phone', 50);
            $table->date('dob');
            $table->string('bio', 200)->nullable()->default('NULL');
            $table->string('country', 50)->nullable()->default('NULL');
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('status', ['1', '0']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
