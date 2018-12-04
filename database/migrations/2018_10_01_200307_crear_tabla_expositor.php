<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaExpositor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expositor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('nombre_completo');
            $table->string('numero_empleado');
            $table->integer('id_escolaridad')->unsigned()->nullable()->default(NULL);
            $table->integer('id_sexo')->unsigned()->nullable()->default(NULL);
            $table->string('extension')->nullable()->default(NULL);
            $table->string('correo')->nullable()->default(NULL);
            $table->string('telefono')->nullable()->default(NULL);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_escolaridad')->references('id')->on('escolaridad');
            $table->foreign('id_sexo')->references('id')->on('sexo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expositor');
    }
}
