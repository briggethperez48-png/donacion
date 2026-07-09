<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apPaterno');
            $table->string('apMaterno')->nullable();
            $table->string('login');
            $table->string('area')->nullable();
            $table->string('unidad')->nullable();
            $table->string('fechaAlta');
            $table->string('telefono')->nullable();
            $table->string('activo');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('responsable')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
