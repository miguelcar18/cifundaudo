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
		$("input[name^='cursoA']").each(function() {
			$("select#curso").find("option[value='"+$(this).val()+"']").prop("disabled", true);
		});
	</script>
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($facturacionCurso, ['route' => ['facturacionCursos.update', $facturacionCurso->id], "method" => "PUT", "name" => "facturacionCursoForm", "id" => "facturacionCursoForm", "class" => "form-horizontal"]) }}
				@include('facturacionCursos.form.FacturacionCursosFormType', ["clientes" => $clientes, 'cursos' => $cursos])
				@if(isset($listado))
                @include('facturacionCursos.form.listaCursos', ['listado' => $listado])
                @else
                @include('facturacionCursos.form.listaCursos')
                @endif
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('facturacionCursos.index'), 'valorData' => 0, 'idBoton' => 'facturacionCursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop