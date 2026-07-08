->nullable()<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatColoniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_colonias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_colonia')->nullable();
            $table->string('colonia')->nullable();
            $table->string('id_delegacion')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('id_entidad')->nullable();
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
        Schema::dropIfExists('cat_colonias');
    }
}
