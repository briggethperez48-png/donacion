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
            $table->string('d_codigo')->nullable();
            $table->string('d_asenta')->nullable();
            $table->string('d_tipo_asenta')->nullable();
            $table->string('D_mnpio')->nullable();
            $table->string('d_estado')->nullable();
            $table->string('d_ciudad')->nullable();
            $table->string('d_CP')->nullable();
            $table->string('c_estado')->nullable();
            $table->string('c_oficina')->nullable();
            $table->string('c_CP')->nullable();
            $table->string('c_tipo_asenta')->nullable();
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
