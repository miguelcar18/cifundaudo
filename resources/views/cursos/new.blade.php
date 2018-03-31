@extends('layouts.base')

@section('titulo')
<title>Agregar curso - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar curso", 'tituloModulo' => "Cursos", 'rutaModulo' => URL::route('cursos.index'), 'tituloSubmodulo' => "Agregar curso"])
@stop

@section('javascripts')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script type="text/javascript">
		$(".file-styled").uniform({
			wrapperClass: 'bg-teal-400',
			fileButtonHtml: '<i class="icon-googleplus5"></i>'
		});
	</script>
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'cursos.store', "name" => "cursoForm", "id" => "cursoForm", "class" => "form-horizontal"]) }}
				@include('cursos.form.CursoFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('cursos.index'), 'valorData' => 1, 'idBoton' => 'cursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop