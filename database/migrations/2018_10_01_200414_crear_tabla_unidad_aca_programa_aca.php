<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUnidadAcaProgramaAca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_aca_programa_aca', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_unidad_academica')->unsigned();
            $table->integer('id_programa_academico')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_unidad_academica')->references('id')->on('unidad_academica');
            $table->foreign('id_programa_academico')->references('id')->on('programa_academico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_aca_programa_aca');
    }
}
