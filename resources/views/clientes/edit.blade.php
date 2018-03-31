@extends('layouts.base')

@section('titulo')
<title>Editar cliente - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar cliente", 'tituloModulo' => "Clientes", 'rutaModulo' => URL::route('clientes.index'), 'tituloSubmodulo' => "Editar cliente"])
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
			{{ Form::model($cliente, ['route' => ['clientes.update', $cliente->id], "method" => "PUT", "name" => "clienteForm", "id" => "clienteForm", "class" => "form-horizontal"]) }}
				@include('clientes.form.ClienteFormType', ["cliente" => $cliente])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('clientes.index'), 'valorData' => 0, 'idBoton' => 'clienteSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop