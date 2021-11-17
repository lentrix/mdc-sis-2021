<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrols', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('program_id')->unsigned();
            $table->bigInteger('term_id')->unsigned();
            $table->string('level', 4);
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->boolean('withdrawn')->default(0);
            $table->timestamp('withdrawn_at')->nullable();
            $table->bigInteger('withdrawn_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('term_id')->references('id')->on('terms');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('withdrawn_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrols');
    }
}
