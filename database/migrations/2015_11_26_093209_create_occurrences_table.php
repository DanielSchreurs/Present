<?php

    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateOccurrencesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('occurrences', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamp('from');
                $table->timestamp('to');
                $table->integer('day');
                $table->timestamp('from_hour');
                $table->timestamp('to_hour');
                $table->integer('cour_id')->unsigned();
                $table->foreign('cour_id')
                    ->references('id')->on('cours')
                    ->onDelete('cascade');
                $table->integer('classe_id')->unsigned();
                $table->foreign('classe_id')
                    ->references('id')->on('classes')
                    ->onDelete('cascade');
                $table->integer('school_id')->unsigned()->nullable();
                $table->foreign('school_id')
                    ->references('id')->on('schools')
                    ->onDelete('cascade');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
                $table->boolean('is_closed')->default(false);
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
            Schema::table('occurrences', function (Blueprint $table) {
                $table->dropForeign('occurrences_cour_id_foreign');
                $table->dropForeign('occurrences_classe_id_foreign');
                $table->dropForeign('occurrences_school_id_foreign');
                $table->dropForeign('occurrences_user_id_foreign');
            });
            Schema::drop('occurrences');
        }
    }
