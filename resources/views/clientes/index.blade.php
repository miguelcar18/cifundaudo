@extends('layouts.base')

@section('titulo')
<title>Clientes - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Clientes", 'tituloModulo' => "Clientes"])
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
                    <th>Email</th>
                    <th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($clientes as $cliente)
				<tr>
					<td>{{ number_format($cliente->cedula, 0, '', '.') }}</td>
					<td>{{ $cliente->nombres." ".$cliente->apellidos }}</td>
					<td>{{ $cliente->email }}</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('clientes.show', $cliente->id) }}" class="btn btn-primary btn-icon" title="Ver {{ $cliente->cedula }}" data-id="{{ $cliente->id }}">
							<i class="icon-eye"></i>
						</a>
						<a href="{{ URL::route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-icon" title="Editar {{ $cliente->cedula }}" data-id="{{ $cliente->id }}">
							<i class="icon-pencil7"></i>
						</a>
						<a href="#" data-id="{{ $cliente->id }}" class="btn btn-danger btn-icon tooltip-error borrar-usuario" data-rel="tooltip" title="Eliminar {{ $cliente->cedula }}" objeto="{{ $cliente->id }}" data-id="{{ $cliente->id }}">
							<i class="icon-cancel-square"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
        {!! Form::open(array('route' => array('clientes.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
        {!! Form::close() !!}
	</div>
@stop