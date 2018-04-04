<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturacionCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion_cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente')->unsigned();
            $table->integer('pagado')->nullable();
            $table->string('codigoPago')->nullable();
            $table->integer('tipoPago')->nullable();
            $table->foreign('cliente')->references('id')->on('clientes')->onDelete('cascade');
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
        Schema::dropIfExists('facturacion_cursos');
    }
}
