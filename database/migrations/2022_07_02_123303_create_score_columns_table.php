<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoreColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_columns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_record_id')->unsigned();
            $table->bigInteger('period_id')->unsigned();
            $table->string('name', 30);
            $table->integer('weight');
            $table->integer('total');
            $table->string('remarks',30)->nullable();
            $table->timestamps();
            $table->foreign('class_record_id')->references('id')->on('class_records');
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('score_columns');
    }
}
