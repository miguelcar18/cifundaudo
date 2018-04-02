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
					<th>Código</th>
					<th>Cédula</th>
                    <th>Nombre y apellido</th>
                    <th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datosFactura as $data)
				<tr>
					<td>{{ $data->id }}</td>
					<td>{{ number_format($data->nombreCliente->cedula, 0, '', '.') }}</td>
					<td>{{ $data->nombreCliente->nombres.' '.$data->nombreCliente->apellidos }}</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('facturacionDiplomados.show', $data->id) }}" class="btn btn-primary btn-icon" title="Ver {{ number_format($data->nombreCliente->cedula, 0, '', '.') }}" data-id="{{ $data->id }}">
							<i class="icon-eye"></i>
						</a>
						<a href="{{ URL::route('facturacionDiplomados.edit', $data->id) }}" class="btn btn-warning btn-icon" title="Editar {{ number_format($data->nombreCliente->cedula, 0, '', '.') }}" data-id="{{ $data->id }}">
							<i class="icon-pencil7"></i>
						</a>
						<a href="#" data-id="{{ $data->id }}" class="btn btn-danger btn-icon tooltip-error borrar-usuario" data-rel="tooltip" title="Eliminar {{ number_format($data->nombreCliente->cedula, 0, '', '.') }}" objeto="{{ $data->id }}">
							<i class="icon-cancel-square"></i>
						</a>
						<a href="{{ URL::route('reporteFacturaDiplomado', $data->id) }}" class="btn bg-teal btn-icon" title="Editar {{ number_format($data->nombreCliente->cedula, 0, '', '.') }}" data-id="{{ $data->id }}" target="_blank">
							<i class="icon-file-pdf"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{!! Form::open(array('route' => array('facturacionDiplomados.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
        {!! Form::close() !!}
	</div>
@stop