<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosFacturaCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_factura_cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('monto');
            $table->integer('curso')->unsigned();
            $table->foreign('curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->integer('facturaCurso')->unsigned();
            $table->foreign('facturaCurso')->references('id')->on('facturacion_cursos')->onDelete('cascade');
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
        Schema::dropIfExists('datos_factura_cursos');
    }
}
