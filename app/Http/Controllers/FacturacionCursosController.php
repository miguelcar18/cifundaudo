<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\Curso;
use Fundaudo\Cliente;
use Fundaudo\FacturacionCurso;
use Fundaudo\DatosFacturaCurso;
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

class FacturacionCursosController extends Controller
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
        $datosFactura = FacturacionCurso::All();
        return view('facturacionCursos.index', compact('datosFactura'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = array('' => "Seleccione") + Cliente::orderBy('id','ASC')->get()->pluck('cedula_nombre', 'id')->toArray();
        $cursos = array('' => "Seleccione") + Curso::where('status', '1')->where('tipo', 'Curso')->pluck('nombre', 'id')->toArray();
        return view('facturacionCursos.new', compact('cursos', 'clientes'));
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
                $buscar     = DatosFacturaCurso::join('facturacion_cursos', 'facturacion_cursos.id', '=', 'datos_factura_cursos.facturaCurso')->where(['cliente' => $cliente, 'curso' => $curso])->count();
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
                FacturacionCurso::create($campos);
                $ultimoIdOrden = \DB::getPdo()->lastInsertId();

                for($i = 0; $i < count($request['cursoA']); $i++){
                    $curso = $request['cursoA'][$i];
                    $monto = $request['montoA'][$i];
                    $camposCarga = [
                        'curso'         => $request['cursoA'][$i], 
                        'monto'         => $request['montoA'][$i],
                        'facturaCurso'  => $ultimoIdOrden
                    ];
                    DatosFacturaCurso::create($camposCarga);
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
     * @param  \Fundaudo\FacturacionCurso  $facturacionCurso
     * @return \Illuminate\Http\Response
     */
    public function show(FacturacionCurso $facturacionCurso)
    {
        $datosCursos = DatosFacturaCurso::where('facturaCurso', $facturacionCurso->id)->get();
        return view('facturacionCursos.show', ['facturacionCurso' => $facturacionCurso, 'datosCursos' => $datosCursos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fundaudo\FacturacionCurso  $facturacionCurso
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturacionCurso $facturacionCurso)
    {
        $listado = DatosFacturaCurso::where('facturaCurso', $facturacionCurso->id)->get();
        $clientes = array('' => "Seleccione") + Cliente::orderBy('id','ASC')->get()->pluck('cedula_nombre', 'id')->toArray();
        $cursos = array('' => "Seleccione") + Curso::where('status', '1')->where('tipo', 'Curso')->pluck('nombre', 'id')->toArray();
        $montoTotal = 0;
        foreach ($listado as $data) {
            $montoTotal = $montoTotal + $data->monto;
        }
        return view('facturacionCursos.edit', ['facturacionCurso' => $facturacionCurso, 'listado' => $listado, 'clientes' => $clientes, 'cursos' => $cursos, 'montoTotal' => $montoTotal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fundaudo\FacturacionCurso  $facturacionCurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacturacionCurso $facturacionCurso)
    {
        if($request->ajax())
        {
            $this->facturacion = $facturacionCurso;
            $campos = [
                'cliente' => $request['cliente'], 
                'pagado'  => 0
            ];
            $this->facturacion->fill($campos);
            $this->facturacion->save();

            for($i = 0; $i < count($request['cursoA']); $i++){
                $busquedaCursos = DatosFacturaCurso::where('facturaCurso', $facturacionCurso->id)->where('curso', $request['cursoA'][$i])->where('monto', $request['montoA'][$i])->get();

                if(count($busquedaCursos) == 0){
                    $curso = $request['cursoA'][$i];
                    $monto = $request['montoA'][$i];

                    $camposCarga = [
                        'curso'         => $request['cursoA'][$i], 
                        'monto'         => $request['montoA'][$i],
                        'facturaCurso'  => $facturacionCurso->id
                    ];
                    DatosFacturaCurso::create($camposCarga);
                }
                else if(count($busquedaCursos) > 0){
                    foreach ($busquedaCursos as $data) {
                        $idBC           = $data->id;
                        $camposCargaCurso = [
                            'curso'         => $request['cursoA'][$i], 
                            'monto'         => $request['montoA'][$i],
                        ];
                        \DB::table('datos_factura_cursos')->where('id', $idBC)->update($camposCargaCurso);
                    }
                }
            }

            $listadoCursosCargados = DatosFacturaCurso::where('facturaCurso', $facturacionCurso->id)->get();

            foreach ($listadoCursosCargados as $dato) {
                if (!in_array($dato->curso, $request['cursoA'])) {
                    DatosFacturaCurso::where('id', $dato->id)->delete();
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
     * @param  \Fundaudo\FacturacionCurso  $facturacionCurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturacionCurso $facturacionCurso)
    {
        $this->facturacion = $facturacionCurso;
        if (is_null ($this->facturacion))
            \App::abort(404);

        DatosFacturaCurso::where('facturaCurso', $facturacionCurso->id)->delete();
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
            return Redirect::route('facturacionCursos.index');
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
        //$buscar  = FacturacionCurso::join('datos_factura_cursos', 'facturacion_cursos.id', '=', 'datos_factura_cursos.facturaCurso')->where(['facturacion_cursos.id' => $id)->get();

        $datos =FacturacionCurso::find($id);
        $cursos = DatosFacturaCurso::where('facturaCurso', $id)->get();
        $pdf = \PDF::loadView('facturacionCursos.factura', compact('datos', 'cursos'));
        return $pdf->stream('reporte.pdf');
    }
}