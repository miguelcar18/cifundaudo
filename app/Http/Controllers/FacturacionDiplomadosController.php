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

            /*Verificación*/
            $contador = 0;
            for($i = 0; $i < count($request['cursoA']); $i++){
                $curso      = $request['cursoA'][$i];
                $cliente    = $request['cliente'];
                $buscar     = DatosFacturaDiplomado::join('facturacion_diplomados', 'facturacion_diplomados.id', '=', 'datos_factura_diplomados.facturaDiplomado')->where(['cliente' => $cliente, 'curso' => $curso])->count();
                if($buscar > 0){
                    $contador++;
                }
            }
            /*Fin verificación*/

            if($contador == 0){
                $campos = [
                    'cliente' => $request['cliente'],
                    'pagado'  => 0
                ];
                FacturacionDiplomado::create($campos);
                $ultimoIdOrden = \DB::getPdo()->lastInsertId();
                for($i = 0; $i < count($request['cursoA']); $i++){
                    $curso = $request['cursoA'][$i];
                    $monto = $request['montoA'][$i];
                    $camposCarga = [
                        'curso'             => $request['cursoA'][$i], 
                        'monto'             => $request['montoA'][$i],
                        'facturaDiplomado'  => $ultimoIdOrden
                    ];
                    DatosFacturaDiplomado::create($camposCarga);
                }
                return response()->json([
                    'validations' => true
                ]);
            } else {
                return response()->json([
                    'validations' => false, 
                    'error' => 'cursoRegistrado'
                ]);
            }
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
        $datosDiplomados = DatosFacturaDiplomado::where('facturaDiplomado', $facturacionDiplomado->id)->get();
        return view('facturacionDiplomados.show', ['facturacionDiplomado' => $facturacionDiplomado, 'datosDiplomados' => $datosDiplomados]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fundaudo\FacturacionDiplomado  $facturacionDiplomado
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturacionDiplomado $facturacionDiplomado)
    {
        $listado = DatosFacturaDiplomado::where('facturaDiplomado', $facturacionDiplomado->id)->get();
        $clientes = array('' => "Seleccione") + Cliente::orderBy('id','ASC')->get()->pluck('cedula_nombre', 'id')->toArray();
        $cursos = array('' => "Seleccione") + Curso::where('status', '1')->where('tipo', 'Diplomado')->pluck('nombre', 'id')->toArray();
        $montoTotal = 0;
        foreach ($listado as $data) {
            $montoTotal = $montoTotal + $data->monto;
        }
        return view('facturacionDiplomados.edit', ['facturacionDiplomado' => $facturacionDiplomado, 'listado' => $listado, 'clientes' => $clientes, 'cursos' => $cursos, 'montoTotal' => $montoTotal]);
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
        if($request->ajax())
        {
            $this->facturacion = $facturacionDiplomado;
            $campos = [
                'cliente' => $request['cliente'],
                'pagado'  => 0
            ];
            $this->facturacion->fill($campos);
            $this->facturacion->save();

            for($i = 0; $i < count($request['cursoA']); $i++){
                $busquedaCursos = DatosFacturaDiplomado::where('facturaDiplomado', $facturacionDiplomado->id)->where('curso', $request['cursoA'][$i])->where('monto', $request['montoA'][$i])->get();

                if(count($busquedaCursos) == 0){
                    $curso = $request['cursoA'][$i];
                    $monto = $request['montoA'][$i];

                    $camposCarga = [
                        'curso'             => $request['cursoA'][$i], 
                        'monto'             => $request['montoA'][$i],
                        'facturaDiplomado'  => $facturacionDiplomado->id
                    ];
                    DatosFacturaDiplomado::create($camposCarga);
                }
                else if(count($busquedaCursos) > 0){
                    foreach ($busquedaCursos as $data) {
                        $idBC           = $data->id;
                        $camposCargaCurso = [
                            'curso'         => $request['cursoA'][$i], 
                            'monto'         => $request['montoA'][$i],
                        ];
                        \DB::table('datos_factura_diplomados')->where('id', $idBC)->update($camposCargaCurso);
                    }
                }
            }

            $listadoCursosCargados = DatosFacturaDiplomado::where('facturaDiplomado', $facturacionDiplomado->id)->get();

            foreach ($listadoCursosCargados as $dato) {
                if (!in_array($dato->curso, $request['cursoA'])) {
                    DatosFacturaDiplomado::where('id', $dato->id)->delete();
                }
            }

            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fundaudo\FacturacionDiplomado  $facturacionDiplomado
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturacionDiplomado $facturacionDiplomado)
    {
        $this->facturacion = $facturacionDiplomado;
        if (is_null ($this->facturacion))
            \App::abort(404);

        DatosFacturaDiplomado::where('facturaDiplomado', $facturacionDiplomado->id)->delete();
        $this->facturacion->delete();
        if (\Request::ajax()){
            return Response::json(array (
                'success' => true,
                'msg'     => 'Factura "' . $this->facturacion->id .'" eliminada satisfactoriamente',
                'id'      => $this->facturacion->id
            ));
        }
        else{
            $mensaje = 'Factura "'. $this->facturacion->id .'" eliminada satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('facturacionDiplomados.index');
        }
    }

    public function buscarMontoCurso(Request $request, $id){
        if($request->ajax()){
            $curso = Curso::find($id);
            return Response::json(array(
                'correcto'  =>  true,
                'curso'     =>  $curso
            ));
        }
    }

    public function reporteFactura($id){
        $datos =FacturacionDiplomado::find($id);
        $cursos = DatosFacturaDiplomado::where('facturaDiplomado', $id)->get();
        $pdf = \PDF::loadView('facturacionDiplomados.factura', compact('datos', 'cursos'));
        return $pdf->stream('reporte.pdf');
    }
}
