@extends('layouts.base')

@section('titulo')
<title>Cuentas por cobrar - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Cuentas por cobrar", 'tituloModulo' => "Cuentas por cobrar"])
@stop

@section('javascripts')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript">
        $(function () {
            @if(Session::has('message'))
                var mensaje1 = "{{ Session::get('message') }}";
                noty({
                    width: 200,
                    text: mensaje1,
                    type: "success",
                    dismissQueue: true,
                    timeout: 4000,
                    layout: "topCenter",
                    buttons: false
                });
            @endif
        });
    </script>

@stop

@section('contenido')
	<div class="panel panel-flat">
		<table class="table datatable-basic">
			<thead>
				<tr>
					<th>Cédula</th>
                    <th>Nombre y apellido</th>
                    <th>Curso</th>
                    <th>Monto</th>
                    <th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>21.453.738</td>
					<td>Maria Sanchez</td>
					<td>Análisis de precios lulown</td>
					<td>30.000</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('cuentas-por-cobrar.show', 1) }}" class="btn btn-primary btn-icon" title="Ver 21.453.738" data-id="1">
							<i class="icon-eye"></i>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@stop