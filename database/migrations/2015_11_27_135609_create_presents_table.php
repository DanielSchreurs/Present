<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')
                ->references('id')->on('students')
                ->onDelete('cascade');
            $table->integer('occurrence_id')->unsigned();
            $table->foreign('occurrence_id')
                ->references('id')->on('occurrences')
                ->onDelete('cascade');
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
        Schema::table('presents',function(Blueprint $table){
            $table->dropForeign('presents_occurrence_id_foreign');
            $table->dropForeign('presents_student_id_foreign');
        });
        Schema::drop('presents');
    }
}
