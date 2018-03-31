<?php

namespace Fundaudo;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cedula', 'tipoPersona', 'nombres', 'apellidos', 'email', 'telefono', 'direccion'
    ];

    /**
    * Obtener la cédula, el nombre y el apellido
    *
    * @return string
    */
    public function getCedulaNombreAttribute(){
        return number_format($this->cedula, 0, '', '.') . ' - ' . $this->nombres . ' ' . $this->apellidos;
    }
}
