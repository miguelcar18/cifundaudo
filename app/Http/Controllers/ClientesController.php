<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\Cliente;
use Illuminate\Http\Request;
use Fundaudo\Http\Requests;
use Fundaudo\Http\Requests\ClientesRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class ClientesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::All();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientesRequest $request)
    {
        if($request->ajax()){
            $campos = [
                'cedula'        => $request['cedula'], 
                'tipoPersona'   => $request['tipoPersona'], 
                'nombres'       => $request['nombres'], 
                'apellidos'     => $request['apellidos'], 
                'email'         => $request['email'], 
                'telefono'      => $request['telefono'], 
                'direccion'     => $request['direccion']
            ];
            Cliente::create($campos);
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fundaudo\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //$this->cliente = Cliente::find($id);
        return view('clientes.show', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fundaudo\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //$this->afiliado = Afiliado::find($id);
        //$cargos = array('' => "Seleccione") + Cargos::pluck('nombre', 'id')->toArray();
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fundaudo\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClientesRequest $request, Cliente $cliente)
    {
        if($request->ajax())
        {
            //$this->afiliado = Afiliado::find($id);
            $campos = [
                'cedula'        => $request['cedula'], 
                'tipoPersona'   => $request['tipoPersona'], 
                'nombres'       => $request['nombres'], 
                'apellidos'     => $request['apellidos'], 
                'email'         => $request['email'], 
                'telefono'      => $request['telefono'], 
                'direccion'     => $request['direccion']
            ];
            $cliente->fill($campos);
            $cliente->save();
            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fundaudo\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        if (is_null ($cliente))
            \App::abort(404);
        $nombreCompleto = $cliente->nombre.' '.$cliente->apellido;
        $id = $cliente->id;
        $cliente->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Cliente "' . $nombreCompleto .'" eliminado satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Cliente "'. $nombreCompleto .'" eliminado satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('clientes.index');
        }
    }
}
