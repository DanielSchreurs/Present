<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassCourPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classe_cour', function (Blueprint $table) {
            $table->integer('classe_id')->unsigned()->index();
            $table->foreign('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->integer('cour_id')->unsigned()->index();
            $table->foreign('cour_id')->references('id')->on('cours')->onDelete('cascade');
            $table->primary(['classe_id', 'cour_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classe_cour');
    }
}
