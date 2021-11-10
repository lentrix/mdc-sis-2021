<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string("day",20); //M, T, W, Th, F, St, Sn
            $table->time('start');
            $table->time('end');
            $table->bigInteger('venue_id')->unsigned();
            $table->bigInteger('subject_class_id')->unsigned();
            $table->timestamps();
            $table->foreign('venue_id')->references('id')->on('venues');
            $table->foreign('subject_class_id')->references('id')->on('subject_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
