<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeminarioAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminario_alumno', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_seminario')->unsigned();
            $table->integer('id_alumno')->unsigned();
            $table->integer('calificacion')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_seminario')->references('id')->on('seminario');
            $table->foreign('id_alumno')->references('id')->on('alumno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seminario_alumno');
    }
}
