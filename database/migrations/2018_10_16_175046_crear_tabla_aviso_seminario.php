<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAvisoSeminario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_seminario', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_entrega_lista_inicial');
            $table->boolean('estado');
            $table->integer('id_seminario')->unsigned();
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
        Schema::table('aviso_seminario', function (Blueprint $table) {
            //
        });
    }
}
