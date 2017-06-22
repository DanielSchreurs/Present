<?php

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
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar');
            $table->rememberToken();
            $table->string('defaultSchoolYearBegin')->default('2015-09-09');
            $table->string('defaultSchoolYearEnd')->default('2016-07-01');
            $table->integer('defaultCoursDuration')->default(50);
            $table->string('defaultDayBegin')->default('08:20');
            $table->string('defaultDayEnd')->default('16:20');
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
        Schema::drop('users');
    }
}