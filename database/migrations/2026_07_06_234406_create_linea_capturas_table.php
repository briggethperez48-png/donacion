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
            $table->string('id_linea_captura')->nullable();
            $table->string('id_donador')->nullable();
            $table->string('linea_captura')->nullable();
            $table->string('id_status')->nullable();
            $table->string('fecha_generada')->nullable();
            $table->string('fecha_pago')->nullable();
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
