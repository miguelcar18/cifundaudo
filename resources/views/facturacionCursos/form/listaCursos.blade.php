<div class="form-group">
	<label class="col-lg-1 control-label">Curso:</label>
	<div class="col-lg-4">
		{!! Form::select('curso', $cursos, null, $attributes = array('id' => 'curso', 'class' => 'form-control')) !!}
	</div>
	<label class="col-lg-1 control-label">Monto:</label>
	<div class="col-lg-4">
		{!! Form::input('number', 'monto', null, array('class' => 'form-control col-md-7 col-xs-12', 'id' => 'monto', 'placeholder' => '0.00', 'min' => 1)) !!}
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
		@if(isset($listado))
        @foreach($listado as $data)
        <tr>
            <td>
                <input type="hidden" name="cursoA[]" id="cursoA[]" value="{{ $data->curso }}" /> {{ ucfirst($data->nombreCurso->nombre) }}
            </td>
            <td>
                <input type="hidden" name="montoA[]" id="montoA[]" value="{{ $data->monto }}" />{{ number_format($data->monto, 2, ',','.') }}
            </td>
            <td>
                <button type="button" onclick="eliminarFilaEditar(this)" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
            </td>
        </tr>
        @endforeach
        @endif
	</tbody>
</table>