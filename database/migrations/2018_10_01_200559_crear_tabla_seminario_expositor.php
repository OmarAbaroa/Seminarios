<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeminarioExpositor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminario_expositor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_expositor')->unsigned();
            $table->integer('id_seminario')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_expositor')->references('id')->on('expositor');
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
        Schema::dropIfExists('seminario_expositor');
    }
}
