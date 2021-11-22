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
            $table->date('fecha_nacimiento')->date_format('Y-m-d');
            $table->integer('padre')->unsigned()->nullable();
            $table->integer('madre')->unsigned()->nullable();
            $table->unsignedBigInteger('domicilio_id')->nullable();
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
