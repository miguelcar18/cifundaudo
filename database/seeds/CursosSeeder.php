<?php

use Illuminate\Database\Seeder;
use Fundaudo\Curso;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	Curso::create( [
    		'nombre'     => 'Excel avanzado',
            'tipo'       => 'Curso',
            'horas'      => '16',
            'costo'      => '65000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Microsoft proyect',
            'tipo'       => 'Curso',
            'horas'      => '16',
            'costo'      => '65000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Análisis de precios lulown',
            'tipo'       => 'Curso',
            'horas'      => '16',
            'costo'      => '65000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Desarrollo gerencial',
            'tipo'       => 'Curso',
            'horas'      => '16',
            'costo'      => '315000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Salud ocupacional',
            'tipo'       => 'Diplomado',
            'horas'      => '100',
            'costo'      => '315000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Derecho laboral',
            'tipo'       => 'Diplomado',
            'horas'      => '100',
            'costo'      => '315000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Producción de gas',
            'tipo'       => 'Diplomado',
            'horas'      => '100',
            'costo'      => '315000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );

    	Curso::create( [
    		'nombre'     => 'Administración tributaria',
            'tipo'       => 'Diplomado',
            'horas'      => '100',
            'costo'      => '315000',
            'status'     => 1,
    		'created_at' => date('Y-m-d H:m:s'),
    		'updated_at' => date('Y-m-d H:m:s')
    	] );
    }
}
