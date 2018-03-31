<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de información para el registro estudiantil a cursos UDO Monagas">
        <meta name="author" content="Miguel Carmona">
		<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
		@section('titulo') <title>Panel principal - FundaUdo</title> @show

		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->

		<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>

		@section('estilos') @show
	</head>
	<body>
		@include('layouts.navbar')
		<div class="page-container">
			<div class="page-content">
				@include('layouts.sidebar')
				<div class="content-wrapper">
					@section('cabecera')
					@include('layouts.breadcrumb', ['titulo' => "Panel de inicio"])
					@show
					<div class="content">
						@section('contenido')
						
						<div class="row">
							<div class="col-lg-3">
								<div class="panel bg-teal-800">
									<div class="panel-body text-bold">
										@if(isset($countClientes))
										<h1 class="no-margin text-bold">{{ $countClientes }}</h1>
										Clientes registrados
										@endif
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="panel bg-warning-800">
									<div class="panel-body text-bold">
										@if(isset($countCursos))
										<h1 class="no-margin text-bold">{{ $countCursos }}</h1>
										Cursos registrados
										@endif
									</div>
									<div id="server-load"></div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="panel bg-blue-800">
									<div class="panel-body text-bold">
										@if(isset($countDiplomados))
										<h1 class="no-margin text-bold">{{ $countDiplomados }}</h1>
										Diplomados registrados
										@endif
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="panel bg-danger-800">
									<div class="panel-body text-bold">
										@if(isset($countCursos) && isset($countDiplomados))
										<h1 class="no-margin text-bold">{{ $countCursos + $countDiplomados }}</h1>
										Clases en total
										@endif
									</div>
								</div>
							</div>
						</div>

						@show
						@include('layouts.footer')
					</div>
				</div>
			</div>
		</div>

		<!-- Core JS files -->
		<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/noty.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/validation/validate.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>

		<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery_ui/full.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js') }}"></script>
		<!-- /core JS files -->

		{{--
		<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
		--}}
		<script type="text/javascript" src="{{ asset('assets/js/numeral.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
		@section('javascripts') 
		@show
	</body>
</html>