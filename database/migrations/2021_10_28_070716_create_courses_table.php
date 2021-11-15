<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('description');
            $table->integer('credit');
            $table->bigInteger('requisite_course')->unsigned()->nullable();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('program_id')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->foreign('requisite_course')->references('id')->on('courses');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
