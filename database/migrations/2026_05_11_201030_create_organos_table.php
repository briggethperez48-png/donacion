<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organos', function (Blueprint $datoOrg) {
            $datoOrg->increments('id_organo');
            $datoOrg->string('organo');
            $datoOrg->string('id_tipo_organo');
            $datoOrg->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organos');
    }
}
