@extends('layouts.base')

@section('titulo') <title>Datos de la cuenta - FundaUdo</title> @stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la cuenta", 'tituloModulo' => "Cuentas por cobrar", 'rutaModulo' => URL::route('cuentas-por-cobrar.index'), 'tituloSubmodulo' => "Datos de la cuenta"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="table-responsive">
			{!! Form::open(['route' => ['cuentas-por-cobrar.destroy', 1], 'method' =>'DELETE', 'id' => 'form-eliminar-cuenta', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar esta cuenta?\')']) !!}
			<table class="table table-bordered table-lg">
				<tbody>
					<tr class="active">
						<th colspan="2">Datos de la cuenta</th>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Cédula</b></td>
						<td>{{ number_format(21453738, 0, '', '.') }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Nombre y apellido</b></td>
						<td>Maria Sanchez</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-3"><b>Curso</b></td>
						<td>
							Análisis de precios lulown - 30.000
						</td>
					</tr>
					{{--
					<tr>
						<td class="col-md-2 col-sm-3"><b>Acciones</b></td>
						<td>
							<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('facturacionCursos.edit', 1) }}'"><i class="icon-pencil7 position-right"></i> Editar</button>
							<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="1"  onclick="return confirmSubmit(document.forms['form-eliminar-factura-curso'], '¿Está realmente seguro de eliminar este cliente?');"><i class="icon-trash position-right"></i> Eliminar</button>
						</td>
					</tr>
					--}}
				</tbody>
			</table>
			{!! form::close() !!}
		</div>
	</div>
@stop