<div class="navbar navbar-inverse">
	<div class="navbar-header">
		{{--
		<a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo_light.png') }}" alt=""></a>
		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
		--}}
	</div>
	<div class="navbar-collapse collapse" id="navbar-mobile">
		{{--
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
		--}}
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					@if(Auth::user()->path == '')
                    <img src="{{ asset('uploads/usuarios/unfile.jpg') }}" alt="user" name="fotoNavbar" id="fotoNavbar">
                    @else
                    <img src="{{ asset('uploads/usuarios/'.Auth::user()->path) }}" alt="Foto de {{ Auth::user()->username }}" name="fotoNavbar" id="fotoNavbar">
                    @endif
					<span>{!! Auth::user()->name !!}</span>
					<i class="caret"></i>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="{{ URL::route('usuarios.show', Auth::user()->id) }}"><i class="icon-vcard"></i> Perfil</a></li>
					<li><a href="{{ URL::route('change_password') }}"><i class="icon-lock"></i> Cambiar contraseña</a></li>
					<li><a href="{{ URL::route('logout') }}"><i class="icon-switch2"></i> Salir</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
