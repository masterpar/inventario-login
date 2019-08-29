<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_user', function (Blueprint $table) {
            $table->increments('id');
            $table->date('f_devolucion');
            $table->string('aprobada')->default('En espera');
            $table->text('justificacion');
            $table->text('observacion')->nullable();
            $table->date('f_devolucion_real')->nullable();
            $table->integer('tool_id')->unsigned();
            $table->foreign('tool_id')
                ->references('id')
                ->on('tools')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('tool_user');
    }
}
