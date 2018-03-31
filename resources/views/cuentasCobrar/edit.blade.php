@extends('layouts.base')

@section('titulo')
<title>Editar factura de curso - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar factura de curso", 'tituloModulo' => "Facturación de cursos", 'rutaModulo' => URL::route('facturacionCursos.index'), 'tituloSubmodulo' => "Editar factura de curso"])
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
			{{ Form::model($cliente, ['route' => ['facturacionCursos.update', $cliente->id], "method" => "PUT", "name" => "facturacionCursoForm", "id" => "facturacionCursoForm", "class" => "form-horizontal"]) }}
				@include('facturacionCursos.form.FacturacionCursosFormType', ["cliente" => $cliente])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('facturacionCursos.index'), 'valorData' => 0, 'idBoton' => 'facturacionCursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop