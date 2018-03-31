@extends('layouts.base')

@section('titulo')
<title>Usuario - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Usuario", 'tituloModulo' => "Usuarios"])
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
					<th>Usuario</th>
                    <th>Nombre y apellido</th>
                    <th>Email</th>
                    <th class="text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td class="text-center" style="padding: 1px">
						<a href="{{ URL::route('usuarios.show', $user->id) }}" class="btn btn-primary btn-icon" title="Ver {{ $user->username }}" data-id="{{ $user->id }}">
							<i class="icon-eye"></i>
						</a>
						<a href="{{ URL::route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-icon" title="Editar {{ $user->username }}" data-id="{{ $user->id }}">
							<i class="icon-pencil7"></i>
						</a>
						<a href="#" data-id="{{ $user->id }}" class="btn btn-danger btn-icon tooltip-error borrar-usuario" data-rel="tooltip" title="Eliminar {{ $user->username }}" objeto="{{ $user->id }}" data-id="{{ $user->id }}">
							<i class="icon-cancel-square"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
        {!! Form::open(array('route' => array('usuarios.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
        {!! Form::close() !!}
	</div>
@stop