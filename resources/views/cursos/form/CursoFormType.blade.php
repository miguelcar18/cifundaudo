<fieldset class="content-group">
	{{--<legend class="text-bold">Basic inputs</legend>--}}
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Nombre <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::text("nombre", null, ["class" => "form-control", "placeholder" => "Nombre del curso", "id" => "nombre"]) }}
		</div>
		<label class="control-label col-lg-1 col-sm-12">Horas <span class="text-danger">*</span></label>
		<div class="col-lg-2 col-sm-12">
			{{ Form::text("horas", null, ["class" => "form-control", "placeholder" => "Número de Horas", "id" => "horas"]) }}
		</div>
		<label class="control-label col-lg-1 col-sm-12">Costo <span class="text-danger">*</span></label>
		<div class="col-lg-2 col-sm-12">
			{!! Form::input('number', 'costo', null, ['id' => 'costo', 'class' => 'form-control', 'placeholder' => '0.00', 'min' => '1']) !!}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Tipo <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::select("tipo", ["" => "Seleccione una opción", "Curso" => "Curso", "Diplomado" => "Diplomado"], null, ["class" => "form-control", "id" => "tipo"]) }}
		</div>
		<label class="control-label col-lg-2 col-sm-12">Status <span class="text-danger">*</span></label>
		<div class="col-lg-4 col-sm-12">
			{{ Form::select("status", ["" => "Seleccione una opción", "1" => "Habilitado", "0" => "Deshabilitado"], null, ["class" => "form-control", "id" => "status"]) }}
		</div>
	</div>
</fieldset>