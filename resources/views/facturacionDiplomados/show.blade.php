@extends('layouts.base')

@section('titulo')<title>Facturción de diplomados - Datos de la factura</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la factura", 'tituloModulo' => "Facturción de diplomados", 'rutaModulo' => URL::route('facturacionDiplomados.index'), 'tituloSubmodulo' => "Datos de la factura"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="table-responsive">
			{!! Form::open(['route' => ['facturacionDiplomados.destroy', $facturacionDiplomado->id], 'method' =>'DELETE', 'id' => 'form-eliminar-factura-diplomado']) !!}
			<table class="table table-bordered table-lg">
				<tbody>
					<tr class="active">
						<th colspan="2">Datos de la factura</th>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Código</b></td>
						<td>{{ $facturacionDiplomado->id }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Cédula</b></td>
						<td>{{ number_format($facturacionDiplomado->nombreCliente->cedula, 0, '', '.') }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Nombre y apellido</b></td>
						<td>{{ $facturacionDiplomado->nombreCliente->nombres.' '.$facturacionDiplomado->nombreCliente->apellidos }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Diplomados registrados</b></td>
						<td>
							<ul>
								@foreach($datosDiplomados as $data)
								<li>{{ $data->nombreCurso->nombre.' - '.number_format($data->monto, 2, ',', '.') }}</li>
								@endforeach
							</ul>
						</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Acciones</b></td>
						<td>
							<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('facturacionDiplomados.edit',$facturacionDiplomado->id) }}'"><i class="icon-pencil7 position-right"></i> Editar</button>
							<button type="button" id="eliminar" name="eliminar" class="btn btn-danger borrar" objeto="1"  onclick="return confirmSubmit(document.forms['form-eliminar-factura-diplomado'], '¿Está realmente seguro de eliminar esta factura?');"><i class="icon-trash position-right"></i> Eliminar</button>
						</td>
					</tr>
				</tbody>
			</table>
			{!! form::close() !!}
		</div>
	</div>
@stop