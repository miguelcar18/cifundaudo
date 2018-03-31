@extends('layouts.base')

@section('titulo')
<title>Cursos - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Cursos", 'tituloModulo' => "Cursos"])
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
					<th>Nombre</th>
                    <th>Tipo</th>
                    <th>Costo</th>
                    <th>Status</th>
                    <th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cursos as $curso)
				<tr>
					<td>{{ $curso->nombre }}</td>
					<td>{{ $curso->tipo }}</td>
					<td>{{ number_format($curso->costo, 2, ',', '.') }}</td>
					<td>
						@if($curso->status == 1)
							Habilitado
						@elseif($curso->status == 0)
							Deshabilitado
						@endif
					</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('cursos.show', $curso->id) }}" class="btn btn-primary btn-icon" title="Ver {{ $curso->nombre }}" data-id="{{ $curso->id }}">
							<i class="icon-eye"></i>
						</a>
						<a href="{{ URL::route('cursos.edit', $curso->id) }}" class="btn btn-warning btn-icon" title="Editar {{ $curso->nombre }}" data-id="{{ $curso->id }}">
							<i class="icon-pencil7"></i>
						</a>
						<a href="#" data-id="{{ $curso->id }}" class="btn btn-danger btn-icon tooltip-error borrar-usuario" data-rel="tooltip" title="Eliminar {{ $curso->nombre }}" objeto="{{ $curso->id }}" data-id="{{ $curso->id }}">
							<i class="icon-cancel-square"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
        {!! Form::open(array('route' => array('cursos.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
        {!! Form::close() !!}
	</div>
@stop