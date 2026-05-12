<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionODTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacion_o_d', function (Blueprint $datoRel) {
            $datoRel->increments('id'); 
        
            $datoRel->unsignedInteger('donante_id');
            $datoRel->unsignedInteger('organo_id');

            $datoRel->foreign('donante_id')
                ->references('id')->on('donantes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $datoRel->foreign('organo_id')
                ->references('id')->on('organos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $datoRel->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relacion_o_d');
    }
}
