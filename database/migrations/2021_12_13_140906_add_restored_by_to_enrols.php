<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestoredByToEnrols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrols', function (Blueprint $table) {
            $table->bigInteger('restored_by')->unsigned()->nullable();
            $table->timestamp('restored_at')->nullable();
            $table->foreign('restored_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrols', function (Blueprint $table) {
            $table->dropColumn('restored_at');
            $table->dropColumn('restored_by');
        });
    }
}
