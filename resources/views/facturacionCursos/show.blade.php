@extends('layouts.base')

@section('titulo')<title>Facturación de cursos - Datos de la factura</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la factura", 'tituloModulo' => "Facturción de cursos", 'rutaModulo' => URL::route('facturacionCursos.index'), 'tituloSubmodulo' => "Datos de la factura"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="table-responsive">
			{!! Form::open(['route' => ['facturacionCursos.destroy', $facturacionCurso->id], 'method' =>'DELETE', 'id' => 'form-eliminar-factura-curso', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar esta factura?\')']) !!}
			<table class="table table-bordered table-lg">
				<tbody>
					<tr class="active">
						<th colspan="2">Datos de la factura</th>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Código</b></td>
						<td>{{ $facturacionCurso->id }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Cédula</b></td>
						<td>{{ number_format($facturacionCurso->nombreCliente->cedula, 0, '', '.') }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Nombre y apellido</b></td>
						<td>{{ $facturacionCurso->nombreCliente->nombres.' '.$facturacionCurso->nombreCliente->apellidos }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Cursos registrados</b></td>
						<td>
							<ul>
								@foreach($datosCursos as $data)
								<li>{{ $data->nombreCurso->nombre.' - '.number_format($data->monto, 2, ',', '.') }}</li>
								@endforeach
							</ul>
						</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Acciones</b></td>
						<td>
							<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('facturacionCursos.edit', $facturacionCurso->id) }}'"><i class="icon-pencil7 position-right"></i> Editar</button>
							<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="1"  onclick="return confirmSubmit(document.forms['form-eliminar-factura-curso'], '¿Está realmente seguro de eliminar esta factura?');"><i class="icon-trash position-right"></i> Eliminar</button>
						</td>
					</tr>
				</tbody>
			</table>
			{!! form::close() !!}
		</div>
	</div>
@stop