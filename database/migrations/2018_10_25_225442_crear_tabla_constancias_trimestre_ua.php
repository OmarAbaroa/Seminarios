<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConstanciasTrimestreUa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constancias_trimestre_ua', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_unidad_academica')->unsigned();
            $table->string('anio');
            $table->string('trimestre');
            $table->integer('numero_constancias')->unsigned()->default('0');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_unidad_academica')->references('id')->on('unidad_academica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
