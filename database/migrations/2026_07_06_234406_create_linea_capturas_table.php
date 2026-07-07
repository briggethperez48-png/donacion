<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineaCapturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_capturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_linea_captura');
            $table->string('id_donador');
            $table->string('linea_captura');
            $table->string('id_status');
            $table->string('fecha_generada');
            $table->string('fecha_pago');
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
        Schema::dropIfExists('linea_capturas');
    }
}
