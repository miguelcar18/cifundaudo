<?php

namespace Fundaudo\Http\Controllers;

use Fundaudo\Curso;
use Illuminate\Http\Request;
use Fundaudo\Http\Requests;
use Fundaudo\Http\Requests\CursosRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class CursosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_admin', ['only' => ['store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::All();
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursosRequest $request)
    {
        if($request->ajax()){
            $campos = [
                'nombre'    => $request['nombre'], 
                'tipo'      => $request['tipo'], 
                'horas'     => $request['horas'], 
                'costo'     => $request['costo'], 
                'status'    => $request['status']
            ];
            Curso::create($campos);
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fundaudo\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        return view('cursos.show', ['curso' => $curso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Fundaudo\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        return view('cursos.edit', ['curso' => $curso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fundaudo\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(CursosRequest $request, Curso $curso)
    {
        $campos = [
            'nombre'    => $request['nombre'], 
            'tipo'      => $request['tipo'], 
            'horas'     => $request['horas'], 
            'costo'     => $request['costo'], 
            'status'    => $request['status']
        ];
        $curso->fill($campos);
        $curso->save();
        return response()->json([
            'validations'       => true,
            'nuevoContenido'    => $campos           
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fundaudo\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        if (is_null ($curso))
            \App::abort(404);
        $nombreCurso = $curso->nombre;
        $id = $curso->id;
        $curso->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Curso "' . $nombreCurso .'" eliminado satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Curso "'. $nombreCurso .'" eliminado satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('cursos.index');
        }
    }
}
