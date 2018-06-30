<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCohortTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohort_topic', function (Blueprint $table) {
            $table->integer('cohort_id')->unsigned();
            $table->integer('topic_id')->unsigned();

            $table->foreign('cohort_id')
                    ->references('id')->on('cohorts')
                    ->onDelete('cascade');

            $table->foreign('topic_id')
                    ->references('id')->on('topics')
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
        Schema::dropIfExists('cohort_qualification_table');
    }
}
