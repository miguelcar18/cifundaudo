{{--<legend class="text-bold">Basic inputs</legend>--}}
<div class="form-group">
	<label class="control-label col-lg-2 col-sm-12">Cliente <span class="text-danger">*</span></label>
	<div class="col-lg-6 col-sm-12">
		{!! Form::select('cliente', $clientes, null, $attributes = array('id' => 'cliente', 'class' => 'form-control select-search')) !!}
	</div>
	<label class="control-label col-lg-1 col-sm-12">Total <span class="text-danger"></span></label>
	<div class="col-lg-3">
		@if(isset($montoTotal))
		{!! Form::text('total', number_format($montoTotal, 2, ',', ''), array('class' => 'form-control col-md-7 col-xs-12 text-right', 'id' => 'total', 'placeholder' => '0,00', 'readOnly' => true)) !!}
		@else
		{!! Form::text('total', '0', array('class' => 'form-control col-md-7 col-xs-12 text-right', 'id' => 'total', 'placeholder' => '0,00', 'readOnly' => true)) !!}
		@endif
	</div>
</div>
