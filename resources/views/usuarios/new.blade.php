@extends('layouts.base')

@section('titulo')
<title>Agregar usuario - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar usuario", 'tituloModulo' => "Usuarios", 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => "Agregar usuario"])
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
			{{ Form::open(["method" => "post", "route" =>'usuarios.store', "name" => "usuarioForm", "id" => "usuarioForm", "class" => "form-horizontal"]) }}
				@include('usuarios.form.UsuarioFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('usuarios.index'), 'valorData' => 1, 'idBoton' => 'usuarioSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop