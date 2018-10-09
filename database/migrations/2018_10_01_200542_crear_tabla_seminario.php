<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeminario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('registro')->nullable()->default(NULL);
            $table->integer('duracion');
            $table->integer('id_unidad_academica')->unsigned();
            $table->string('sede')->nullable()->default(NULL);
            $table->integer('id_tipo_seminario')->unsigned();
            $table->boolean('cronograma')->default("0");
            $table->boolean('programa')->default("0");
            $table->boolean('cv_expositores')->default("0");
            $table->boolean('pago')->default("0");
            $table->boolean('rua')->default("0");
            $table->boolean('lista_oficial')->default("0");
            $table->boolean('relacion_asistencia')->default("0");
            $table->boolean('evaluacion_final')->default("0");
            $table->boolean('trabajos_finales')->default("0");
            $table->date('vigencia_inicio')->nullable()->default(NULL);
            $table->date('vigencia_fin')->nullable()->default(NULL);
            $table->date('periodo_inicio')->nullable()->default(NULL);
            $table->date('periodo_fin')->nullable()->default(NULL);
            $table->integer('impartido')->default("0");

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_unidad_academica')->references('id')->on('unidad_academica');
            $table->foreign('id_tipo_seminario')->references('id')->on('tipo_seminario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seminario');
    }
}
