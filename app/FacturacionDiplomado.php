<?php

namespace Fundaudo;

use Illuminate\Database\Eloquent\Model;

class FacturacionDiplomado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facturacion_diplomados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente', 'pagado', 'codigoPago', 'tipoPago'
    ];

    public function nombreCliente(){
        return $this->hasOne('Fundaudo\Cliente', 'id', 'cliente');
    }
}
