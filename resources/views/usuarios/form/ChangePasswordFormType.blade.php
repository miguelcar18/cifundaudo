<fieldset class="content-group">
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Contraseña actual<span class="text-danger">*</span></label>
		<div class="col-lg-2 col-sm-12">
			{{ Form::password("password_actual", ["class" => "form-control", "placeholder" => "Contraseña actual", "id" => "password_actual"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Contraseña nueva<span class="text-danger">*</span></label>
		<div class="col-lg-2 col-sm-12">
			{{ Form::password("password", ["class" => "form-control", "placeholder" => "Contraseña nueva", "id" => "password"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Confirmar contraseña <span class="text-danger">*</span></label>
		<div class="col-lg-2 col-sm-12">
			{{ Form::password("password_confirmation", ["class" => "form-control", "placeholder" => "Repetir contraseña", "id" => "password_confirmation"]) }}
		</div>
	</div>
</fieldset>