<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\CuentaCobrar;
use Illuminate\Http\Request;
use Fundaudo\Curso;
use Fundaudo\Cliente;
use Fundaudo\FacturacionCurso;
use Fundaudo\DatosFacturaCurso;
use Fundaudo\Http\Requests;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class CuentasCobrarController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosFactura = DatosFacturaCurso::All();
        return view('cuentasCobrar.index', compact('datosFactura'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cuentasCobrar.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fundaudo\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DatosFacturaCurso::find($id);
        return view('cuentasCobrar.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fundaudo\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function edit(/*CuentaCobrar $cuentaCobrar*/)
    {
        return view('cuentasCobrar.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fundaudo\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaCobrar $cuentaCobrar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fundaudo\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaCobrar $cuentaCobrar)
    {
        //
    }
}
