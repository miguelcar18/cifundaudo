@extends('layouts.base')

@section('titulo')
<title>Agregar cliente - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar cliente", 'tituloModulo' => "Clientes", 'rutaModulo' => URL::route('clientes.index'), 'tituloSubmodulo' => "Agregar cliente"])
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
			{{ Form::open(["method" => "post", "route" =>'clientes.store', "name" => "clienteForm", "id" => "clienteForm", "class" => "form-horizontal"]) }}
				@include('clientes.form.ClienteFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('clientes.index'), 'valorData' => 1, 'idBoton' => 'clienteSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop