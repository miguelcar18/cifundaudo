<?php

namespace Fundaudo;

use Illuminate\Database\Eloquent\Model;

class DatosFacturaDiplomado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'datos_factura_diplomados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monto', 'curso', 'facturaDiplomado'
    ];

    public function nombreCurso(){
        return $this->hasOne('Fundaudo\Curso', 'id', 'curso');
    }

    public function nombreFacturacionDiplomado(){
        return $this->hasOne('Fundaudo\FacturacionDiplomado', 'id', 'facturaDiplomado');
    }
}
