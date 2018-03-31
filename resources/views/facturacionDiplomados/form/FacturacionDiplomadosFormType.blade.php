<fieldset class="content-group">
	{{--<legend class="text-bold">Basic inputs</legend>--}}
	<div class="form-group">
		<label class="control-label col-lg-2 col-sm-12">Cliente <span class="text-danger">*</span></label>
		<div class="col-lg-6 col-sm-12">
			<select class="select-search">
				<option value="1">19.224.657 - Pedro Perez</option>
				<option value="2">21.453.738 - Maria Sanchez</option>
			</select>
		</div>
		<label class="control-label col-lg-1 col-sm-12">Total <span class="text-danger"></span></label>
		<div class="col-lg-3">
			{!! Form::text('total', null, array('class' => 'form-control col-md-7 col-xs-12 text-right', 'id' => 'total', 'placeholder' => '315.000', 'readOnly' => true)) !!}
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-1 control-label">Diplomado:</label>
		<div class="col-lg-9">
			{!! Form::select('curso', $cursos, null, $attributes = array('id' => 'curso', 'class' => 'form-control')) !!}
		</div>
		<div class="col-lg-2">
			<button type="button" id="agregarFila" class="btn btn-primary btn-block" onClick="agregarValor()"><i class="icon-plus2 position-right"></i></i> Agregar</button>
		</div>
	</div>
	<table class="table table-striped table-hover table-full-width table-condensed" id="tablaCargaFamiliar">
		<thead>
			<tr>
				<th class="col-sm-*" style="width:60%">Curso</th>
				<th class="col-sm-*" style="width:30%">Monto</th>
				<th class="col-sm-*" style="width:10%">Opción</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input type="hidden" name="nombreA[]" id="nombreA[]" value="Derecho laboral" /> Derecho laboral
				</td>
				<td>
					<input type="hidden" name="relacionA[]" id="relacionA[]" value="315000" />315000
				</td>
				<td>
					<button type="button" onclick="eliminarFila(this)" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>