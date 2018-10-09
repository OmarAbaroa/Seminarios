<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFuncionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_escolaridad')->unsigned();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('nombre_completo');
            $table->string('cargo');
            $table->integer('id_sexo')->unsigned()->nullable();
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
        Schema::dropIfExists('funcionario');
    }
}
