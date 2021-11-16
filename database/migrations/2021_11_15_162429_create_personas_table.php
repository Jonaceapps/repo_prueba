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
            $table->string('dni', 10)-> unique();
            $table->mediumInteger('telefono') -> unsigned() -> unique();
            $table->text('direccion');
            $table->string('email', 100)-> nullable()-> unique();
            $table->string('pass', 200)-> nullable();
            $table->timestamps(); //fecha de creacion y fecha de ultima edicion
        });
    }

    public function app(){
<<<<<<< Updated upstream
        //probando 2, noo tocar
=======
        //probandoo
>>>>>>> Stashed changes
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