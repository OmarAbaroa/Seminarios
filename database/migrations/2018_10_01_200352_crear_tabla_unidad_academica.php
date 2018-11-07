<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUnidadAcademica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_academica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clave');
            $table->string('siglas');
            $table->string('nombre');
            $table->boolean('rvoe')->default("0")->nulleable();
            $table->integer('id_area')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_area')->references('id')->on('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_academica');
    }
}
