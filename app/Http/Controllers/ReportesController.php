<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\Cliente;
use Fundaudo\CuentaCobrar;
use Fundaudo\Curso;
use Fundaudo\DatosFacturaCurso;
use Fundaudo\DatosFacturaDiplomado;
use Fundaudo\FacturacionCurso;
use Fundaudo\FacturacionDiplomado;
use Fundaudo\User;
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

class ReportesController extends Controller
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
        $anios = [];
        $anioActual = date('Y');
        for($i = -3; $i< 4; $i++){
            $anios[$anioActual + $i] = $anioActual + $i;
        }
        $anios = array('' => "Seleccione una opción", '0' => "Todos") + $anios;
        return view('reportes.index', compact('anios'));
    }

    public function resultados(Request $request)
    {
        $anio       = $request['anio'];
        $reporte    = $request['reporte'];
        $mes        = $request['mes'];

        switch ($mes) {
            case (0):{
                $nombreMes = "";
                break;
            }
            case (1):{
                $nombreMes = "Enero";
                break;
            }
            case (2):{
                $nombreMes = "Febrero";
                break;
            }
            case (3):{
                $nombreMes = "Marzo";
                break;
            }
            case (4):{
                $nombreMes = "Abril";
                break;
            }
            case (5):{
                $nombreMes = "Mayo";
                break;
            }
            case (6):{
                $nombreMes = "Junio";
                break;
            }
            case (7):{
                $nombreMes = "Julio";
                break;
            }
            case (8):{
                $nombreMes = "Agosto";
                break;
            }
            case (9):{
                $nombreMes = "Septiembre";
                break;
            }
            case (10):{
                $nombreMes = "Octubre";
                break;
            }
            case (11):{
                $nombreMes = "Noviembre";
                break;
            }
            case (12):{
                $nombreMes = "Diciembre";
                break;
            }
        }

        switch ($reporte) {
            case ("Clientes"):{
                if($anio == "0" && $mes == "0"){
                    $datos = Cliente::orderBy('nombres','ASC')->get();
                }
                else if($anio == "0" && $mes != "0"){
                    $datos = Cliente::whereMonth('updated_at', '=', $mes)->orderBy('nombres','ASC')->get();
                }
                else if($anio != "0" && $mes == "0"){
                    $datos = Cliente::whereYear('updated_at', '=', $anio)->orderBy('nombres','ASC')->get();
                } else {
                    $datos = Cliente::whereMonth('updated_at', '=', $mes)->whereYear('updated_at', '=', $anio)->orderBy('nombres','ASC')->get();
                }
                $pdf = \PDF::loadView('reportes.reporteClientes', compact('anio', 'mes', 'nombreMes', 'reporte', 'datos'));
                return $pdf->stream('Reporte de'.$request['reporte'].' '.$request['anio'].'.pdf');
                break;
            }
            case ("Cursos"):{
                if($anio == "0" && $mes == "0"){
                    $datos = Curso::where('tipo', 'Curso')->orderBy('nombre','ASC')->get();
                }
                else if($anio == "0" && $mes != "0"){
                    $datos = Curso::where('tipo', 'Curso')->whereMonth('updated_at', '=', $mes)->orderBy('nombre','ASC')->get();
                }
                else if($anio != "0" && $mes == "0"){
                    $datos = Curso::where('tipo', 'Curso')->whereYear('updated_at', '=', $anio)->orderBy('nombre','ASC')->get();
                } else {
                    $datos = Curso::where('tipo', 'Curso')->whereMonth('updated_at', '=', $mes)->whereYear('updated_at', '=', $anio)->orderBy('nombre','ASC')->get();
                }
                $pdf = \PDF::loadView('reportes.reporteCursos', compact('anio', 'mes', 'nombreMes', 'reporte', 'datos'));
                return $pdf->stream('Reporte de'.$request['reporte'].' '.$request['anio'].'.pdf');
                break;
            }
            case ("Diplomados"):{
                if($anio == "0" && $mes == "0"){
                    $datos = Curso::where('tipo', 'Diplomado')->orderBy('nombre','ASC')->get();
                }
                else if($anio == "0" && $mes != "0"){
                    $datos = Curso::where('tipo', 'Diplomado')->whereMonth('updated_at', '=', $mes)->orderBy('nombre','ASC')->get();
                }
                else if($anio != "0" && $mes == "0"){
                    $datos = Curso::where('tipo', 'Diplomado')->whereYear('updated_at', '=', $anio)->orderBy('nombre','ASC')->get();
                } else {
                    $datos = Curso::where('tipo', 'Diplomado')->whereMonth('updated_at', '=', $mes)->whereYear('updated_at', '=', $anio)->orderBy('nombre','ASC')->get();
                }
                $pdf = \PDF::loadView('reportes.reporteDiplomados', compact('anio', 'mes', 'nombreMes', 'reporte', 'datos'));
                return $pdf->stream('Reporte de'.$request['reporte'].' '.$request['anio'].'.pdf');
                break;
            }
            case ("Facturas cursos"):{
                if($anio == "0" && $mes == "0"){
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaCurso AS id, cliente, nombres, apellidos FROM datos_factura_cursos INNER JOIN facturacion_cursos ON datos_factura_cursos.facturaCurso = facturacion_cursos.id INNER JOIN clientes ON facturacion_cursos.cliente = clientes.id GROUP BY facturaCurso ORDER BY nombres ASC');
                }
                else if($anio == "0" && $mes != "0"){
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaCurso AS id, cliente, nombres, apellidos FROM datos_factura_cursos INNER JOIN facturacion_cursos ON datos_factura_cursos.facturaCurso = facturacion_cursos.id INNER JOIN clientes ON facturacion_cursos.cliente = clientes.id WHERE MONTH(facturacion_cursos.updated_at) = '.$mes.' GROUP BY facturaCurso ORDER BY nombres ASC');
                }
                else if($anio != "0" && $mes == "0"){
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaCurso AS id, cliente, nombres, apellidos FROM datos_factura_cursos INNER JOIN facturacion_cursos ON datos_factura_cursos.facturaCurso = facturacion_cursos.id INNER JOIN clientes ON facturacion_cursos.cliente = clientes.id WHERE YEAR(facturacion_cursos.updated_at) = '.$anio.' GROUP BY facturaCurso ORDER BY nombres ASC');
                } else {
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaCurso AS id, cliente, nombres, apellidos FROM datos_factura_cursos INNER JOIN facturacion_cursos ON datos_factura_cursos.facturaCurso = facturacion_cursos.id INNER JOIN clientes ON facturacion_cursos.cliente = clientes.id WHERE MONTH(facturacion_cursos.updated_at) = '.$mes.' AND YEAR(facturacion_cursos.updated_at) = '.$anio.' GROUP BY facturaCurso ORDER BY nombres ASC');
                }
                $pdf = \PDF::loadView('reportes.reporteFacturasCursos', compact('anio', 'mes', 'nombreMes', 'reporte', 'datos'));
                return $pdf->stream('Reporte de'.$request['reporte'].' '.$request['anio'].'.pdf');
                break;
            }
            case ("Facturas diplomados"):{
                if($anio == "0" && $mes == "0"){

                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaDiplomado AS id, cliente, nombres, apellidos FROM datos_factura_diplomados INNER JOIN facturacion_diplomados ON datos_factura_diplomados.facturaDiplomado = facturacion_diplomados.id INNER JOIN clientes ON facturacion_diplomados.cliente = clientes.id GROUP BY facturaDiplomado ORDER BY nombres ASC');
                }
                else if($anio == "0" && $mes != "0"){
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaDiplomado AS id, cliente, nombres, apellidos FROM datos_factura_diplomados INNER JOIN facturacion_diplomados ON datos_factura_diplomados.facturaDiplomado = facturacion_diplomados.id INNER JOIN clientes ON facturacion_diplomados.cliente = clientes.id WHERE MONTH(facturacion_diplomados.updated_at) = '.$mes.' GROUP BY facturaDiplomado ORDER BY nombres ASC');
                }
                else if($anio != "0" && $mes == "0"){
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaDiplomado AS id, cliente, nombres, apellidos FROM datos_factura_diplomados INNER JOIN facturacion_diplomados ON datos_factura_diplomados.facturaDiplomado = facturacion_diplomados.id INNER JOIN clientes ON facturacion_diplomados.cliente = clientes.id WHERE YEAR(facturacion_diplomados.updated_at) = '.$anio.' GROUP BY facturaDiplomado ORDER BY nombres ASC');
                } else {
                    $datos = \DB::select('SELECT  COUNT(*) AS cantidad, SUM(monto) AS total, facturaDiplomado AS id, cliente, nombres, apellidos FROM datos_factura_diplomados INNER JOIN facturacion_diplomados ON datos_factura_diplomados.facturaDiplomado = facturacion_diplomados.id INNER JOIN clientes ON facturacion_diplomados.cliente = clientes.id WHERE MONTH(facturacion_diplomados.updated_at) = '.$mes.' AND YEAR(facturacion_diplomados.updated_at) = '.$anio.' GROUP BY facturaDiplomado ORDER BY nombres ASC');
                }
                $pdf = \PDF::loadView('reportes.reporteFacturasDiplomados', compact('anio', 'mes', 'nombreMes', 'reporte', 'datos'));
                return $pdf->stream('Reporte de'.$request['reporte'].' '.$request['anio'].'.pdf');
                break;
            }
        }
    }

    public function estadisticas(){
        $cursosMasSolicitados = \DB::select('SELECT  COUNT(*) AS cantidad, curso, nombre FROM datos_factura_cursos INNER JOIN cursos ON datos_factura_cursos.curso = cursos.id GROUP BY curso ORDER BY cantidad DESC LIMIT 5');
        $diplomadosMasSolicitados = \DB::select('SELECT  COUNT(*) AS cantidad, curso, nombre FROM datos_factura_diplomados INNER JOIN cursos ON datos_factura_diplomados.curso = cursos.id GROUP BY curso ORDER BY cantidad DESC LIMIT 5');

        $cursosMenosSolicitados = \DB::select('SELECT  COUNT(*) AS cantidad, curso, nombre FROM datos_factura_cursos INNER JOIN cursos ON datos_factura_cursos.curso = cursos.id GROUP BY curso ORDER BY cantidad ASC LIMIT 5');
        $diplomadosMenosSolicitados = \DB::select('SELECT  COUNT(*) AS cantidad, curso, nombre FROM datos_factura_diplomados INNER JOIN cursos ON datos_factura_diplomados.curso = cursos.id GROUP BY curso ORDER BY cantidad ASC LIMIT 5');

        return view('estadisticas.index', compact('cursosMasSolicitados', 'diplomadosMasSolicitados', 'cursosMenosSolicitados', 'diplomadosMenosSolicitados'));
    }
}
