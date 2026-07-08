<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hist_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_usuario')->nullable();
            $table->string('nombre_usuario')->nullable();
            $table->string('paterno_usuario')->nullable();
            $table->string('materno_usuario')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();
            $table->string('id_modulo')->nullable();
            $table->string('id_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hist_usuarios');
    }
}
