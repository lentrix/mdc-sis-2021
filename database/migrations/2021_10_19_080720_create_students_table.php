<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('id_number')->unsigned();
            $table->string('id_extension',5)->nullable();
            $table->string('lrn')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('sex', 6);
            $table->date('birth_date');
            $table->string('civil_status',20)->nullable();
            $table->string('religion',60)->nullable();
            $table->string('street')->nullable();
            $table->string('barangay')->nullable();
            $table->string('town')->nullable();
            $table->string('province')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('nationality',60)->default('filipino');
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('occupation_mother')->nullable();
            $table->string('father_father')->nullable();
            $table->string('parents_address')->nullable();
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
        Schema::dropIfExists('students');
    }
}
