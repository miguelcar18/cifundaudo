<fieldset class="content-group">
	<div class="form-group">
		<label class="control-label col-lg-1 col-sm-12">Factura <span class="text-danger">*</span></label>
		<div class="col-lg-3 col-sm-12">
			{{ Form::select("factura", $facturas, null, ["class" => "form-control", "id" => "factura"]) }}
		</div>
		<label class="control-label col-lg-1 col-sm-12">Tipo <span class="text-danger">*</span></label>
		<div class="col-lg-3 col-sm-12">
			{{ Form::select("tipoPago", ["" => "Seleccione una opción", "1" => "Depósito", "2" => "Transferencia"], null, ["class" => "form-control", "id" => "tipoPago"]) }}
		</div>
		<label class="control-label col-lg-1 col-sm-12">Nº depos. o transf. <span class="text-danger">*</span></label>
		<div class="col-lg-3 col-sm-12">
			{{ Form::text("codigoPago", null, ["class" => "form-control", "placeholder" => "Código de recepción", "id" => "codigoPago"]) }}
		</div>
	</div>
</fieldset>