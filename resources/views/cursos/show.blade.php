@extends('layouts.base')

@section('titulo')<title> Cursos - Datos del curso </title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del curso", 'tituloModulo' => "Cursos", 'rutaModulo' => URL::route('cursos.index'), 'tituloSubmodulo' => "Datos del curso"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="table-responsive">
			{!! Form::open(['route' => ['cursos.destroy', $curso->id], 'method' =>'DELETE', 'id' => 'form-eliminar-curso', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este curso?\')']) !!}
			<table class="table table-bordered table-lg">
				<tbody>
					<tr class="active">
						<th colspan="2">Datos del curso</th>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Nombre</b></td>
						<td>{{ $curso->nombre }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Tipo</b></td>
						<td>{{ $curso->tipo }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Horas</b></td>
						<td>{{ $curso->horas }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Costo</b></td>
						<td>{{ number_format($curso->costo, 2, ',', '.') }}</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Status</b></td>
						<td>
							@if($curso->status == 1)
							Habilitado
							@elseif($curso->status == 0)
							Deshabilitado
							@endif
						</td>
					</tr>
					<tr>
						<td class="col-md-2 col-sm-3"><b>Acciones</b></td>
						<td>
							<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('cursos.edit', $curso->id) }}'"><i class="icon-pencil7 position-right"></i> Editar</button>
							<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $curso->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-curso'], '¿Está realmente seguro de eliminar este curso?');"><i class="icon-trash position-right"></i> Eliminar</button>
						</td>
					</tr>
				</tbody>
			</table>
			{!! form::close() !!}
		</div>
	</div>
@stop