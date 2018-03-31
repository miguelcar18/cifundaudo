<fieldset class="content-group">
	{{--<legend class="text-bold">Basic inputs</legend>--}}
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Cédula <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("cedula", null, ["class" => "form-control", "placeholder" => "Número de cédula", "id" => "cedula"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Tipo de persona <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::select("tipoPersona", ["" => "Seleccione una opción", "N" => "Natural", "J" => "Jurídica"], null, ["class" => "form-control", "id" => "tipoPersona"]) }}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Nombres <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("nombres", null, ["class" => "form-control", "placeholder" => "Nombres", "id" => "nombres"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Apellidos <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("apellidos", null, ["class" => "form-control", "placeholder" => "Apellidos", "id" => "apellidos"]) }}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Email <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::email("email", null, ["class" => "form-control", "placeholder" => "example@email.com", "id" => "email"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Teléfono <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("telefono", null, ["class" => "form-control", "placeholder" => "Número de teléfono", "id" => "telefono"]) }}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Dirección</label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::textarea("direccion", null, ["rows" => 5, "cols" => 5, "id" => "direccion", "class" => "form-control", "placeholder" => "Dirección"]) }}
		</div>
	</div>
</fieldset>