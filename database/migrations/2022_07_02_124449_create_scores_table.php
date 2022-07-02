<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigInteger('score_column_id')->unsigned();
            $table->bigInteger('enrol_subject_id')->unsigned();
            $table->integer('score')->nullable();
            $table->timestamps();
            $table->foreign('score_column_id')->references('id')->on('score_columns');
            $table->foreign('enrol_subject_id')->references('id')->on('enrol_subjects');
            $table->primary(['score_column_id','enrol_subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
