@extends('layouts.base')

@section('titulo')
<title>Agregar factura de curso - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar factura de curso", 'tituloModulo' => "Facturación de cursos", 'rutaModulo' => URL::route('facturacionCursos.index'), 'tituloSubmodulo' => "Agregar factura de curso"])
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
			{{ Form::open(["method" => "post", "route" =>'facturacionCursos.store', "name" => "facturacionCursoForm", "id" => "facturacionCursoForm", "class" => "form-horizontal"]) }}
				<fieldset class="content-group">
				@include('facturacionCursos.form.FacturacionCursosFormType', ['cursos' => $cursos])
				@if(isset($listado))
                @include('facturacionCursos.form.listaCursos', ['listado' => $listado])
                @else
                @include('facturacionCursos.form.listaCursos')
                @endif
				</fieldset>
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('facturacionCursos.index'), 'valorData' => 1, 'idBoton' => 'facturacionCursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop