<?php

namespace Fundaudo\Http\Controllers;

use Illuminate\Http\Request;
use Fundaudo\Cliente;
use Fundaudo\Curso;
use Fundaudo\FacturacionCurso;
use Fundaudo\FacturacionDiplomado;
use Fundaudo\Http\Requests;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class BackController extends Controller{
    
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$countClientes = Cliente::count();
		$countCursos = Curso::where('tipo', 'Curso')->count();
		$countDiplomados = Curso::where('tipo', 'Diplomado')->count();
		return view("layouts.base", compact('countClientes', 'countCursos', 'countDiplomados'));
	}

	public function cargarReciboPago (){
		$facturasCursos 	= FacturacionCurso::all();
		$facturasDiplomados = FacturacionDiplomado::all();
		$facturas = [];

		foreach($facturasCursos as $data){
			$facturas['C-'.$data->id] = 'C-'.$data->id;
		}
		foreach($facturasDiplomados as $data){
			$facturas['D-'.$data->id] = 'D-'.$data->id;
		}

		$facturas = array('' => "Seleccione") + $facturas;

		return view('reciboPagos.index', compact('facturas'));
	}

	public function postCargarReciboPago (Request $request){
		if($request->ajax()){
			$separarId = explode('-', $request['factura']);
			if($separarId[0] == 'C'){
				$recibo = FacturacionCurso::find($separarId[1]);
			} else if($separarId[0] == 'D') {
				$recibo = FacturacionDiplomado::find($separarId[1]);
			}
			$campos = [
				'pagado' 		=> 1, 
				'codigoPago'   	=> $request['codigoPago'], 
				'tipoPago'      => $request['tipoPago']
			];
			$recibo->fill($campos);
			$recibo->save();
            return response()->json([
                'validations' => true
            ]);
        }
	}
}