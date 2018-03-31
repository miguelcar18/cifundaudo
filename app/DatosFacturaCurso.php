<?php

namespace Fundaudo;

use Illuminate\Database\Eloquent\Model;

class DatosFacturaCurso extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'datos_factura_cursos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monto', 'curso', 'facturaCurso'
    ];

    public function nombreCurso(){
        return $this->hasOne('Fundaudo\Curso', 'id', 'curso');
    }

    public function nombreFacturacionCurso(){
        return $this->hasOne('Fundaudo\FacturacionCurso', 'id', 'facturaCurso');
    }
}
