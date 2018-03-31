<div class="page-header">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-section position-left"></i>{{ $titulo }}</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="{{ URL::route('principal') }}"><i class="icon-home2 position-left"></i> Inicio</a></li>
			@if(isset($tituloModulo))
			<li @if(!isset($tituloSubmodulo)) class="active" @endif>
				@if(isset($tituloSubmodulo))
				<a href="{{ $rutaModulo }}">{{ $tituloModulo }}</a>
				@else
				{{ $tituloModulo }}
				@endif
			</li>
			@endif
			@if(isset($tituloSubmodulo))
			<li class="active">{{ $tituloSubmodulo }}</li>
			@elseif(!isset($tituloModulo))
			<li class="active">Panel</li>
			@endif
		</ul>
	</div>
</div>