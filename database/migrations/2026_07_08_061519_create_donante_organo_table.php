<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonanteOrganoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('relacion_o_d');

        // 2. CREAMOS LA NUEVA TABLA PIVOTE BIEN ESTRUCTURADA
        Schema::create('donante_organo', function (Blueprint $table) {
            // Llaves foráneas con tus nombres reales de columna
            // $table->increments('id_organo_donado');
            $table->integer('id_donador');
            $table->integer('id_organo');
            
            // Llave primaria compuesta (Evita que se duplique el mismo órgano en el mismo donador)
            $table->primary(['id_donador', 'id_organo']);
            
            // Índices para que PostgreSQL vuele al cruzar información en las vistas
            $table->index('id_donador');
            $table->index('id_organo');

            // Restricciones de integridad (Opcional, pero ideal si ya migraste donantes y organos)
            // $table->foreign('id_donador')->references('id_donador')->on('donantes')->onDelete('cascade');
            // $table->foreign('id_organo')->references('id_organo')->on('organos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donante_organo');
    }
}
