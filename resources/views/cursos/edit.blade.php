@extends('layouts.base')

@section('titulo')
<title>Editar curso - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar curso", 'tituloModulo' => "Cursos", 'rutaModulo' => URL::route('cursos.index'), 'tituloSubmodulo' => "Editar curso"])
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
			{{ Form::model($curso, ['route' => ['cursos.update', $curso->id], "method" => "PUT", "name" => "cursoForm", "id" => "cursoForm", "class" => "form-horizontal"]) }}
				@include('cursos.form.CursoFormType', ["curso" => $curso])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('cursos.index'), 'valorData' => 0, 'idBoton' => 'cursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop