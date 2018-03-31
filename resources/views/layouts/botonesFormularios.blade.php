<div class="text-right">
	{!! Form::button('Cancelar <i class="icon-cross2 position-right"></i>', ['class' => "btn btn-default", 'id' => "cancelar", 'type' => "button", 'onclick' => "document.location.href = '".$rutaCancelar."'"]) !!}
	{!! Form::button($tituloBoton.' <i class="icon-checkmark position-right"></i>', ['type' => "submit", 'class' => "btn btn-primary", 'data' => $valorData, 'id' => $idBoton]) !!}
</div>