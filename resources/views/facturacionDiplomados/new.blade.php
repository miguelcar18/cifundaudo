@extends('layouts.base')

@section('titulo')
<title>Agregar factura de diplomado - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar factura de diplomado", 'tituloModulo' => "Facturación de diplomados", 'rutaModulo' => URL::route('facturacionDiplomados.index'), 'tituloSubmodulo' => "Agregar factura de diplomado"])
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
			{{ Form::open(["method" => "post", "route" =>'facturacionDiplomados.store', "name" => "facturacionDiplomadoForm", "id" => "facturacionDiplomadoForm", "class" => "form-horizontal"]) }}
			<fieldset class="content-group">
				@include('facturacionDiplomados.form.FacturacionDiplomadosFormType', ['cursos' => $cursos])
				@if(isset($listado))
				@include('facturacionDiplomados.form.listaCursos', ['listado' => $listado])
				@else
				@include('facturacionDiplomados.form.listaCursos')
				@endif
			</fieldset>
			@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('facturacionDiplomados.index'), 'valorData' => 1, 'idBoton' => 'facturacionDiplomadoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop