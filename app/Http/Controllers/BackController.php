<?php

namespace Fundaudo\Http\Controllers;

use Illuminate\Http\Request;
use Fundaudo\Cliente;
use Fundaudo\Curso;

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
}