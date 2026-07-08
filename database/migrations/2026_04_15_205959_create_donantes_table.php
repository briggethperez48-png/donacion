<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('donantes', function (Blueprint $datoD) {
            $datoD->increments('id_donador');
            
            // Textos libres largos (los dejamos como text para que NUNCA se trunquen)
            $datoD->text('Nombre')->nullable();
            $datoD->text('ApPaterno')->nullable();
            $datoD->text('ApMaterno')->nullable();
            $datoD->text('Ocupacion')->nullable();
            $datoD->text('Calle')->nullable();    
            $datoD->text('NumExt')->nullable();
            $datoD->text('NumInt')->nullable();
            $datoD->text('Telefono')->nullable();
            $datoD->text('Referencias')->nullable();
            $datoD->text('CURP')->nullable();
            
            // --- AQUÍ ESTÁ EL CAMBIO CLAVE: Columnas que guardan IDs de Catálogos ---
            // Los cambiamos a integer para que PostgreSQL sepa exactamente qué tipo de dato reciben
            $datoD->integer('Sexo')->nullable();
            $datoD->integer('EstCiv')->nullable();
            $datoD->integer('Estudios')->nullable();
            $datoD->integer('Tipo')->nullable();      // Tipo de donación
            $datoD->integer('Religion')->nullable();
            
            // Fechas y Controles (Los dejamos en texto o enteros según tu control histórico)
            $datoD->text('FechaNac')->nullable();
            $datoD->text('CP')->nullable();
            $datoD->text('EstadoProc')->nullable();
            $datoD->text('Alcaldia')->nullable();
            $datoD->text('Colonia')->nullable();
            $datoD->text('Fecha')->nullable();
            $datoD->text('Hora')->nullable();
            $datoD->text('estadoNac')->nullable(); // Si es ID de entidad, puedes dejarlo text o cambiarlo a integer
            $datoD->string('Donador')->nullable();  // Almacena el ratio (0 o 1)
            
            $datoD->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $datoD->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donantes');
    }
}
