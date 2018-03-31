<?php

namespace Fundaudo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        switch($this->method())
        {
            case 'GET':
            case 'DELETE': { return []; }
            case 'POST': {
                return [
                    'cedula'        => 'required|unique:clientes', 
                    'tipoPersona'   => 'required',
                    'email'         => 'required|unique:clientes', 
                    'nombres'       => 'required', 
                    'apellidos'     => 'required',
                    'telefono'      => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'cedula'        => 'required', 
                    'tipoPersona'   => 'required',
                    'email'         => 'required', 
                    'nombres'       => 'required', 
                    'apellidos'     => 'required',
                    'telefono'      => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'cedula.required'       => 'El campo :attribute es obligatorio.', 
            'tipoPersona.required'  => 'El campo :attribute es obligatorio.',
            'email.required'        => 'El campo :attribute es obligatorio.', 
            'nombres.required'      => 'El campo :attribute es obligatorio.', 
            'apellidos.required'    => 'El campo :attribute es obligatorio.', 
            'telefono.required'     => 'El campo :attribute es obligatorio.', 
            'cedula.unique'         => 'La :attribute ingresada ya ha sido registrado.', 
            'email.unique'          => 'El :attribute ingresado ya ha sido registrado.'
        ];
    }

    public function attributes(){
        return [
            'cedula'        => 'çédula', 
            'nombres'       => 'nombres',
            'apellidos'     => 'apellidos',
            'email'         => 'email', 
            'tipoPersona'   => 'tipo de persona', 
            'telefono'      => 'telefono',
            'direccion'     => 'direccion'
        ];
    }

    public function response(array $errors){
        if ($this->expectsJson()){
            return response()->json([
                'validations'   => false, 
                'errors'        => $errors
            ]);
        }

        return $this->redirector->to($this->getRedirectUrl())
        ->withInput($this->except($this->dontFlash))
        ->withErrors($errors, $this->errorBag);
    }
}
