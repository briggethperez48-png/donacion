<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosalcaldiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipiosalcaldias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ClaveEntidad');
            $table->string('Entidad');
            $table->string('ClaveMuni');
            $table->string('Municipio');
            $table->string('ClaveLoc');
            $table->string('Localidad');
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
        Schema::dropIfExists('municipiosalcaldias');
    }
}
