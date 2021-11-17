<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrol_subjects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enrol_id')->unsigned();
            $table->bigInteger('subject_class_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->decimal('mgrade', 2, 1)->nullable();
            $table->decimal('fgrade', 2, 1)->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->timestamps();
            $table->foreign('enrol_id')->references('id')->on('enrols');
            $table->foreign('subject_class_id')->references('id')->on('subject_classes');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrol_subjects');
    }
}
