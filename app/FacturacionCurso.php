<?php

namespace Fundaudo;

use Illuminate\Database\Eloquent\Model;

class FacturacionCurso extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facturacion_cursos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente'
    ];

    public function nombreCliente(){
        return $this->hasOne('Fundaudo\Cliente', 'id', 'cliente');
    }
}
