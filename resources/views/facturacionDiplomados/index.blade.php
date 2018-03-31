@extends('layouts.base')

@section('titulo')
<title>Facturción de diplomados - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Facturación de diplomados", 'tituloModulo' => "Facturación de diplomados"])
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
	<div class="alert alert-primary alert-styled-left">
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
		<a href="{{ URL::route('facturacionDiplomados.create') }}" class="alert-link"><span class="text-semibold">Para ingresar una factura nueva</span> seleccione esta url</a>
	</div>
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
					<td>19.224.657</td>
					<td>Pedro Perez</td>
					<td>Derecho laboral</td>
					<td>315.000</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('facturacionDiplomados.show', 1) }}" class="btn btn-primary btn-icon" title="Ver 19.224.657" data-id="1">
							<i class="icon-eye"></i>
						</a>
						<a href="{{ URL::route('facturacionDiplomados.edit', 1) }}" class="btn btn-warning btn-icon" title="Editar 19.224.657" data-id="1">
							<i class="icon-pencil7"></i>
						</a>
						<a href="#" data-id="1" class="btn btn-danger btn-icon tooltip-error borrar-usuario" data-rel="tooltip" title="Eliminar 19.224.657" objeto="1" data-id="1">
							<i class="icon-cancel-square"></i>
						</a>
					</td>
				</tr>
				<tr>
					<td>21.453.738</td>
					<td>Maria Sanchez</td>
					<td>Producción de gas</td>
					<td>315.000</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('facturacionDiplomados.show', 1) }}" class="btn btn-primary btn-icon" title="Ver 21.453.738" data-id="1">
							<i class="icon-eye"></i>
						</a>
						<a href="{{ URL::route('facturacionDiplomados.edit', 1) }}" class="btn btn-warning btn-icon" title="Editar 21.453.738" data-id="1">
							<i class="icon-pencil7"></i>
						</a>
						<a href="#" data-id="1" class="btn btn-danger btn-icon tooltip-error borrar-usuario" data-rel="tooltip" title="Eliminar 21.453.738" objeto="1" data-id="1">
							<i class="icon-cancel-square"></i>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
@stop