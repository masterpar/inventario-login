<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petition_tools', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad')->unsigned();
            $table->integer('cantidad_aprobada')->unsigned()->default(0);
            $table->integer('cantidad_devuelta')->unsigned()->default(0);
            $table->integer('petition_id')->unsigned();
            $table->foreign('petition_id')
                ->references('id')
                ->on('petitions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('tool_id')->unsigned();
            $table->foreign('tool_id')
                ->references('id')
                ->on('tools')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('petition_tools');
    }
}
