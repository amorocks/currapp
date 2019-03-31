<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('classes_per_week')->unsigned()->nullable();
            $table->float('hours_per_class')->nullable();
            $table->text('review')->nullable();

            $table->foreign('course_id')
                    ->references('id')->on('courses')
                    ->onDelete('cascade');

            $table->foreign('term_id')
                    ->references('id')->on('terms')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editions');
    }
}
