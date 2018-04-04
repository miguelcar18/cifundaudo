<div class="sidebar sidebar-main">
	<div class="sidebar-content">
		<div class="sidebar-user">
			<div class="category-content">
				<div class="media">
					<a href="#" class="media-left">
						@if(Auth::user()->path == '')
                        <img src="{{ asset('uploads/usuarios/unfile.jpg') }}" alt="user" class="img-circle img-sm" alt="Foto de {{ Auth::user()->username }}" name="fotoSidebar" id="fotoSidebar">
                        @else
                        <img src="{{ asset('uploads/usuarios/'.Auth::user()->path) }}" class="img-circle img-sm" alt="Foto de {{ Auth::user()->username }}" name="fotoSidebar" id="fotoSidebar">
                        @endif
					</a>
					<div class="media-body">
						<span class="media-heading text-semibold">{!! Auth::user()->name !!}</span>
						<div class="text-size-mini text-muted">
							<i class="icon-user-tie text-size-small"></i> &nbsp;
							@if(Auth::user()->rol == 1)
							Administrador
							@elseif(Auth::user()->rol == 0)
							Usuario
							@elseif(Auth::user()->rol == 3)
							Cliente
							@endif
							{{-- <i class="icon-user text-size-small"></i> &nbsp;Usuario --}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">
					<li class="navigation-header"><span>Menú Principal</span> <i class="icon-menu" title="Main pages"></i></li>
					<li @if(Route::getCurrentRoute()->getName() == 'principal') class="active"  @else class="" @endif ><a href="{{ URL::route('principal') }}"><i class="icon-home4"></i> <span>Inicio</span></a></li>
					@if(Auth::user()->rol != 3)
					<li>
						<a href="#"><i class="icon-address-book"></i> <span>Clientes</span></a>
						<ul>
							<li @if(Route::getCurrentRoute()->getName() == 'clientes.index' or 
                    			Route::getCurrentRoute()->getName() == 'clientes.show' or 
                    			Route::getCurrentRoute()->getName() == 'clientes.edit') class="active" @endif><a href="{{ URL::route('clientes.index') }}">Listado</a></li>
							<li @if(Route::getCurrentRoute()->getName() == 'clientes.create') class="active" @endif><a href="{{ URL::route('clientes.create') }}">Agregar</a></li>
						</ul>
					</li>
					@endif
					<li>
						<a href="#"><i class="icon-books"></i> <span>Cursos</span></a>
						<ul>
							<li @if(Route::getCurrentRoute()->getName() == 'cursos.index' or 
                    			Route::getCurrentRoute()->getName() == 'cursos.show' or 
                    			Route::getCurrentRoute()->getName() == 'cursos.edit') class="active" @endif><a href="{{ URL::route('cursos.index') }}">Listado</a></li>
                    		@if(Auth::user()->rol != 3)
							<li @if(Route::getCurrentRoute()->getName() == 'cursos.create') class="active" @endif><a href="{{ URL::route('cursos.create') }}">Agregar</a></li>
							@endif
						</ul>
					</li>
					@if(Auth::user()->rol != 3)
					<li>
						<a href="#"><i class="icon-calculator2"></i> <span>Facturación</span></a>
						<ul>
							<li @if(Route::getCurrentRoute()->getName() == 'facturacionCursos.index' or 
                    			Route::getCurrentRoute()->getName() == 'facturacionCursos.show' or 
                    			Route::getCurrentRoute()->getName() == 'facturacionCursos.edit' or 
                    			Route::getCurrentRoute()->getName() == 'facturacionCursos.new')) class="active" @endif><a href="{{ URL::route('facturacionCursos.index') }}">Cursos</a></li>
							<li @if(Route::getCurrentRoute()->getName() == 'facturacionDiplomados.index' or 
                    			Route::getCurrentRoute()->getName() == 'facturacionDiplomados.show' or 
                    			Route::getCurrentRoute()->getName() == 'facturacionDiplomados.edit' or 
                    			Route::getCurrentRoute()->getName() == 'facturacionDiplomados.new') class="active" @endif><a href="{{ URL::route('facturacionDiplomados.index') }}">Diplomados</a></li>
						</ul>
					</li>
					<li @if(Route::getCurrentRoute()->getName() == 'cuentas-por-cobrar.index' or 
            			Route::getCurrentRoute()->getName() == 'cuentas-por-cobrar.show' or 
            			Route::getCurrentRoute()->getName() == 'cuentas-por-cobrar.edit' or 
            			Route::getCurrentRoute()->getName() == 'cuentas-por-cobrar.new')) class="active"  @else class="" @endif ><a href="{{ URL::route('cuentas-por-cobrar.index') }}"><i class="icon-cash"></i> <span>Cuentas por cobrar</span></a></li>
					<li>
					<li @if(Route::getCurrentRoute()->getName() == 'cargarReciboPago') class="active"  @else class="" @endif ><a href="{{ URL::route('cargarReciboPago') }}"><i class="icon-file-upload"></i> <span>Cargar recibo de pago</span></a></li>
					<li>
					<li @if(Route::getCurrentRoute()->getName() == 'estadisticas') class="active"  @else class="" @endif ><a href="{{ URL::route('estadisticas') }}"><i class="icon-pie-chart2"></i> <span>Estadisticas</span></a></li>
					<li>
						<a href="#"><i class="icon-users"></i> <span>Usuarios</span></a>
						<ul>
							<li @if(Route::getCurrentRoute()->getName() == 'usuarios.index' or 
                    			Route::getCurrentRoute()->getName() == 'usuarios.show' or 
                    			Route::getCurrentRoute()->getName() == 'usuarios.edit') class="active" @endif><a href="{{ URL::route('usuarios.index') }}">Listado</a></li>
							<li @if(Route::getCurrentRoute()->getName() == 'usuarios.create') class="active" @endif><a href="{{ URL::route('usuarios.create') }}">Agregar</a></li>
						</ul>
					</li>
					<li @if(Route::getCurrentRoute()->getName() == 'reportes') class="active"  @else class="" @endif ><a href="{{ URL::route('reportes') }}"><i class="icon-file-pdf"></i> <span>Reportes</span></a></li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>