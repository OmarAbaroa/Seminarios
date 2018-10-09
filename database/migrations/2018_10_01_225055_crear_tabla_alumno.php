<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('nombre_completo');
            $table->string('boleta')->unique();
            $table->integer('id_sexo')->unsigned()->nullable();
            $table->integer('id_ua_pa')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_sexo')->references('id')->on('sexo');
            $table->foreign('id_ua_pa')->references('id')->on('unidad_aca_programa_aca');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno');
    }
}
