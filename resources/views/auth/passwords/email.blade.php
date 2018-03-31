<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Restaurar contraseña - Fundaudo</title>
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
						@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif					
						{!! Form::open(array('route' => 'password.email', 'method' => 'post', 'id' => 'formEmailPassword', 'name' => 'formEmailPassword',  "class" => "form-validate")) !!}
							<div class="panel panel-body login-form">
								<div class="text-center">
									<div class="">
										<img src="{{ asset('assets/images/logo_udo.svg') }}" alt="" width="150px" height="auto">
									</div>
									<h5 class="content-group">FUNDAUDO <small class="display-block">Restaurar contraseña</small></h5>
								</div>
								<div class="form-group has-feedback has-feedback-left">
									{!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email', 'required' => true, 'value' => old('email')]) !!}
									<div class="form-control-feedback">
										<i class="icon-mail5 text-muted"></i>
									</div>
								</div>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
								<div class="form-group">
									{!! Form::button('Enviar correo de restauración  <i class="icon-circle-right2 position-right"></i>', ['class'=> 'btn btn-primary btn-block', 'id' => 'EmailPasswordButton', 'type' => 'submit']) !!}
								</div>
								<div class="text-center">
									<a href="{{ URL::route('login') }}">Regresar al login</a>
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
