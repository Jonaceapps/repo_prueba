<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('primer_apellido', 150);
            $table->string('segundo_apellido', 150);
            $table->dateTime('fecha_nacimiento');
            $table->integer('padres')->unsigned();
            $table->unsignedBigInteger('domicilio_id');
            $table->foreign('domicilio_id')->references('id')->on('domicilios');
            $table->timestamps(); //fecha de creacion y fecha de ultima edicion
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
