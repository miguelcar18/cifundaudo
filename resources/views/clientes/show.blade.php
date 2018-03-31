@extends('layouts.base')

@section('titulo')Clientes - Datos del cliente@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del cliente", 'tituloModulo' => "Clientes", 'rutaModulo' => URL::route('clientes.index'), 'tituloSubmodulo' => "Datos del cliente"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="table-responsive">
			{!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' =>'DELETE', 'id' => 'form-eliminar-cliente', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este cliente?\')']) !!}
			<table class="table table-bordered table-lg">
				<tbody>
					<tr class="active">
						<th colspan="2">Datos del cliente</th>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Cédula</b></td>
						<td>{{ number_format($cliente->cedula, 0, '', '.') }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Nombres</b></td>
						<td>{{ $cliente->nombres }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Apellidos</b></td>
						<td>{{ $cliente->apellidos }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Tipo de persona</b></td>
						<td>
							@if($cliente->tipoPersona == "N")
							Natural
							@elseif($cliente->tipoPersona == "J")
							Jurídica
							@endif
						</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Email</b></td>
						<td>{{ $cliente->email }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Teléfono</b></td>
						<td>{{ $cliente->telefono }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Dirección</b></td>
						<td>{{ $cliente->direccion }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Acciones</b></td>
						<td>
							<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('clientes.edit', $cliente->id) }}'"><i class="icon-pencil7 position-right"></i> Editar</button>
							<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $cliente->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-curso'], '¿Está realmente seguro de eliminar este cliente?');"><i class="icon-trash position-right"></i> Eliminar</button>
						</td>
					</tr>
				</tbody>
			</table>
			{!! form::close() !!}
		</div>
	</div>
@stop