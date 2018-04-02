@extends('layouts.base')

@section('titulo')
<title>Editar factura de diplomado - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar factura de diplomado", 'tituloModulo' => "Facturación de diplomados", 'rutaModulo' => URL::route('facturacionDiplomados.index'), 'tituloSubmodulo' => "Editar factura de diplomado"])
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
			{{ Form::model($facturacionDiplomado, ['route' => ['facturacionDiplomados.update', $facturacionDiplomado->id], "method" => "PUT", "name" => "facturacionDiplomadoForm", "id" => "facturacionDiplomadoForm", "class" => "form-horizontal"]) }}
				@include('facturacionDiplomados.form.FacturacionDiplomadosFormType', ["clientes" => $clientes, 'cursos' => $cursos])
				@if(isset($listado))
                @include('facturacionDiplomados.form.listaCursos', ['listado' => $listado])
                @else
                @include('facturacionDiplomados.form.listaCursos')
                @endif
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('facturacionDiplomados.index'), 'valorData' => 0, 'idBoton' => 'facturacionDiplomadoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop