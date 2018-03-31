<?php

namespace Fundaudo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
                    'nombre'    => 'required|unique:cursos', 
                    'tipo'      => 'required',
                    'horas'     => 'required|numeric', 
                    'costo'     => 'required|numeric', 
                    'status'    => 'required'
                ];
            }
            case 'PUT': {
                return [
                    'nombre'    => 'required', 
                    'tipo'      => 'required',
                    'horas'     => 'required|numeric', 
                    'costo'     => 'required|numeric', 
                    'status'    => 'required'
                ];
            }
            case 'PATCH': { return []; }
            default:break;
        }
    }

    public function messages(){
        return [
            'nombre.required'   => 'El campo :attribute es obligatorio.', 
            'tipo.required'     => 'El campo :attribute es obligatorio.',
            'horas.required'    => 'El campo :attribute es obligatorio.', 
            'costo.required'    => 'El campo :attribute es obligatorio.', 
            'status.required'   => 'El campo :attribute es obligatorio.', 
            'nombre.unique'     => 'El :attribute ingresado ya ha sido registrado.', 
            'horas.numeric'      => 'El campo :attribute debe contener solo números.', 
            'costo.numeric'      => 'El campo :attribute debe contener solo números.', 
        ];
    }

    public function attributes(){
        return [
            'nombre'    => 'nombre', 
            'tipo'      => 'tipo',
            'horas'     => 'horas',
            'costo'     => 'costo', 
            'status'    => 'status'
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
