<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDirector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('director', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_cargo');
            $table->integer('id_unidad_academica')->unsigned();
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
        Schema::dropIfExists('director');
    }
}
