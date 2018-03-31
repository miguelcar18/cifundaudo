<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\Curso;
use Fundaudo\Cliente;
use Fundaudo\FacturacionDiplomado;
use Fundaudo\DatosFacturaDiplomado;
use Illuminate\Http\Request;
use Fundaudo\Http\Requests;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class FacturacionDiplomadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosFactura = FacturacionDiplomado::All();
        return view('facturacionDiplomados.index', compact('datosFactura'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = array('' => "Seleccione") + Cliente::orderBy('id','ASC')->get()->pluck('cedula_nombre', 'id')->toArray();
        $cursos = array('' => "Seleccione") + Curso::where('status', '1')->where('tipo', 'Diplomado')->pluck('nombre', 'id')->toArray();
        return view('facturacionDiplomados.new', compact('cursos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $campos = [
                'cliente' => $request['cliente']
            ];
            FacturacionDiplomado::create($campos);
            $ultimoIdOrden = \DB::getPdo()->lastInsertId();
            for($i = 0; $i < count($request['cursoA']); $i++){
                $curso = $request['cursoA'][$i];
                $camposCarga = [
                    'curso'         => $request['cursoA'][$i], 
                    'facturaCurso'  => $ultimoIdOrden
                ];
                DatosFacturaDiplomado::create($camposCarga);
            }

            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fundaudo\FacturacionDiplomado  $facturacionDiplomado
     * @return \Illuminate\Http\Response
     */
    public function show(FacturacionDiplomado $facturacionDiplomado)
    {
        return view('facturacionDiplomados.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fundaudo\FacturacionDiplomado  $facturacionDiplomado
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturacionDiplomado $facturacionDiplomado)
    {
        return view('facturacionDiplomados.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fundaudo\FacturacionDiplomado  $facturacionDiplomado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacturacionDiplomado $facturacionDiplomado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fundaudo\FacturacionDiplomado  $facturacionDiplomado
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturacionDiplomado $facturacionDiplomado)
    {
        //
    }
}
