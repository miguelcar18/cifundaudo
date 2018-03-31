<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\CuentaCobrar;
use Illuminate\Http\Request;

class CuentasCobrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cuentasCobrar.index');
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
    public function show(/*CuentaCobrar $cuentaCobrar*/)
    {
        return view('cuentasCobrar.show');
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
