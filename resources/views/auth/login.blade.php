<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Inicio de sesión - Fundaudo</title>
		<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->
	</head>
	<body>	
		<div class="navbar navbar-inverse">
			<div class="navbar-header">
				{{--<a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo_light.png') }}" alt=""></a>--}}
				<ul class="nav navbar-nav pull-right visible-xs-block">
					<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				</ul>
			</div>
		</div>		
		<div class="page-container login-container">		
			<div class="page-content">			
				<div class="content-wrapper">				
					<div class="content">					
						{!! Form::open(array('route' => 'login', 'method' => 'post', 'id' => 'formLogin', 'name' => 'formLogin',  "class" => "form-validate")) !!}
							<div class="panel panel-body login-form">
								<div class="text-center">
									<div class="">
										<img src="{{ asset('assets/images/logo_udo.svg') }}" alt="" width="150px" height="auto">
									</div>
									<h5 class="content-group">FUNDAUDO <small class="display-block">Inicio de sesión</small></h5>
								</div>
								<div class="form-group has-feedback has-feedback-left">
									{!! Form::text('username', null, ['placeholder' => 'Nombre de usuario', 'class' => 'form-control', 'id' => 'username', 'required' => true]) !!}
									<div class="form-control-feedback">
										<i class="icon-user text-muted"></i>
									</div>
								</div>
								<div class="form-group has-feedback has-feedback-left">
									{!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'form-control', 'id' => 'password', 'required' => true]) !!}
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>
								<div class="form-group">
									{!! Form::button('Ingresar  <i class="icon-circle-right2 position-right"></i>', ['class'=> 'btn btn-primary btn-block', 'id' => 'loginButton', 'type' => 'submit']) !!}
								</div>
								<div class="text-center">
									<a href="{{ URL::route('password.request') }}">¿Olvidó su contraseña?</a>
								</div>
							</div>
						{!! form::close() !!}									
						<div class="footer text-muted">
							&copy; 2017. <a href="#">Universidad de Oriente - Núcleo Monagas</a>
						</div>					
					</div>				
				</div>			
			</div>		
		</div>

		<!-- Core JS files -->
		<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/validation/validate.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/noty.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
		<!-- /theme JS files -->
	</body>
</html>
