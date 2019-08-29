<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('justificacion');
            $table->text('observacion')->nullable();
            $table->text('observacion_admin')->nullable();
            $table->date('f_devolucion');
            $table->date('f_apartada')->nullable();
            $table->date('f_aprobada')->nullable();
            $table->date('f_devolucion_real')->nullable();
            $table->string('estado')->default('Pendiente');
            $table->string('recogida')->nullable();
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
        Schema::dropIfExists('petitions');
    }
}
