<fieldset class="content-group">
	{{--<legend class="text-bold">Basic inputs</legend>--}}
	@if(isset($user))
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Imagen actual </label>
		<div class="col-lg-4 col-sm-12">
			@if($user->path == '')
            <img name="fotoActual" id="fotoActual" src="{{ asset('uploads/usuarios/unfile.jpg') }}" class="img-responsive" alt="" width="150px" height="auto">
            @else
            <img name="fotoActual" id="fotoActual" src="{{ asset('uploads/usuarios/'.$user->path) }}" class="img-responsive" alt="" width="150px" height="auto">
            @endif
		</div>
	</div>
	@endif
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Nombre y apellido <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("name", null, ["class" => "form-control", "placeholder" => "Nombre y apellido", "id" => "name"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Email <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::email("email", null, ["class" => "form-control", "placeholder" => "example@email.com", "id" => "email"]) }}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Rol de usuario <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::select("rol", ["" => "Seleccione una opción", "1" => "Administrador", "0" => "Usuario"], null, ["class" => "form-control", "id" => "rol"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Nombre de usuario <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("username", null, ["class" => "form-control", "placeholder" => "Nombre de usuario", "id" => "username"]) }}
		</div>
	</div>
	@if(!isset($user))
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Contraseña <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::password("password", ["class" => "form-control", "placeholder" => "Contraseña", "id" => "password"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Confirmar contraseña <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::password("repeatPassword", ["class" => "form-control", "placeholder" => "Repetir contraseña", "id" => "repeatPassword"]) }}
		</div>
	</div>
	@endif
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Foto de perfil</label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::file("foto", ["class" => "form-control file-styled", "id" => "foto"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Observaciones</label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::textarea("details", null, ["rows" => 5, "cols" => 5, "id" => "details", "class" => "form-control", "placeholder" => "Detalles u observaciones"]) }}
		</div>
	</div>
</fieldset>