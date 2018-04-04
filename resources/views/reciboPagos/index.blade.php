@extends('layouts.base')

@section('titulo')
<title>Cargar recibo de pago - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Cargar recibo de pago", 'tituloModulo' => "Cargar recibo de pago"])
@stop

@section('javascripts')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'postCargarReciboPago', "name" => "reciboForm", "id" => "reciboForm", "class" => "form-horizontal"]) }}
				@include('reciboPagos.form.ReciboPagoFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('principal'), 'valorData' => 1, 'idBoton' => 'reciboSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop