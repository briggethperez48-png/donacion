<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatCallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_calles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_calle');
            $table->string('id_colonia')->nullable();
            $table->string('descripcion_calle')->nullable();
            $table->string('id_delegacion')->nullable();
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
        Schema::dropIfExists('cat_calles');
    }
}
