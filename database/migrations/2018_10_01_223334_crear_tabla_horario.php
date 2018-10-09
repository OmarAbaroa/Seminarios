<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaHorario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_seminario')->unsigned();
            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_seminario')->references('id')->on('seminario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario');
    }
}
