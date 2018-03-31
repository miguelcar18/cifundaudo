<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosFacturaDiplomadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_factura_diplomados', function (Blueprint $table) {
            $table->increments('id');
            $table->double('monto');
            $table->integer('curso')->unsigned();
            $table->foreign('curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->integer('facturaDiplomado')->unsigned();
            $table->foreign('facturaDiplomado')->references('id')->on('facturacion_diplomados')->onDelete('cascade');
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
        Schema::dropIfExists('datos_factura_diplomados');
    }
}
