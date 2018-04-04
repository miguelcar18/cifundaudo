<fieldset class="content-group">
	{{--<legend class="text-bold">Basic inputs</legend>--}}
	<div class="form-group">
		<label class="control-label col-lg-1 col-sm-12">Reporte <span class="text-danger">*</span></label>
		<div class="col-lg-3 col-sm-12">
			{{ Form::select("reporte", ["" => "Seleccione una opción", "Clientes" => "Clientes", "Cursos" => "Cursos", "Diplomados" => "Diplomados", "Facturas cursos" => "Facturas cursos", "Facturas diplomados" => "Facturas diplomados"], null, ["class" => "form-control", "id" => "reporte"]) }}
		</div>
		<label class="control-label col-lg-1 col-sm-12">Mes <span class="text-danger">*</span></label>
		<div class="col-lg-3 col-sm-12">
			{{ Form::select("mes", ["" => "Seleccione una opción", "0" => "Todo el año", "1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre"], null, ["class" => "form-control", "id" => "mes"]) }}
		</div>
		<label class="control-label col-lg-1 col-sm-12">Año <span class="text-danger">*</span></label>
		<div class="col-lg-3 col-sm-12">
			{{ Form::select("anio", $anios, null, ["class" => "form-control", "id" => "anio"]) }}
		</div>
	</div>
</fieldset>