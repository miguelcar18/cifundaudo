@extends('layouts.base')

@section('titulo')
<title>Reportes - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Reportes", 'tituloModulo' => "Reportes"])
@stop

@section('javascripts')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'resuldatosReportes', "name" => "reporteForm", "id" => "reporteForm", "class" => "form-horizontal", 'target' => '_blank']) }}
				@include('reportes.form.ReporteFormType')
				<div class="text-right">
					{!! Form::button('Mostrar <i class="icon-file-pdf position-right"></i>', ['type' => "submit", 'class' => "btn btn-primary", 'data' => 1, 'id' => 'reporteSubmit']) !!}
				</div>
			{{ Form::close() }}
		</div>
	</div>
@stop