<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawnSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawn_subjects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enrol_id')->unsigned();
            $table->bigInteger('subject_class_id')->unsigned();
            $table->timestamps();
            $table->foreign('enrol_id')->references('id')->on('enrols');
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
        Schema::dropIfExists('withdrawn_subjects');
    }
}
