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
				@foreach($datosFactura as $data)
				@if($data->monto < $data->nombreCurso->costo)
				<tr>
					<td>{{ number_format($data->nombreFacturacionCurso->nombreCliente->cedula, 0, '', '.') }}</td>
					<td>{{ $data->nombreFacturacionCurso->nombreCliente->nombres.' '.$data->nombreFacturacionCurso->nombreCliente->apellidos }}</td>
					<td>{{ $data->nombreCurso->nombre }}</td>
					<td>{{ number_format($data->nombreCurso->costo - $data->monto, 2, ',', '.') }}</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('cuentas-por-cobrar.show', $data->id) }}" class="btn btn-primary btn-icon" title="Ver {{ number_format($data->nombreFacturacionCurso->nombreCliente->cedula, 0, '', '.') }}" data-id="1">
							<i class="icon-eye"></i>
						</a>
					</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>
	</div>
@stop