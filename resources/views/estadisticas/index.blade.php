@extends('layouts.base')

@section('titulo')
<title>Estadisticas - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Estadisticas", 'tituloModulo' => "Estadisticas"])
@stop

@section('estilos') 
	
@stop

@section('javascripts')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/echarts/echarts.js') }}"></script>
	<!-- /theme JS files -->
	<script type="text/javascript">
		$(function () {
			/*** Set paths ****/
			require.config({
				paths: {
					echarts: 'assets/js/plugins/visualization/echarts'
				}
			});

			/**** Configuration ****/
			require(
				[
				'echarts',
				'echarts/theme/limitless',
				'echarts/chart/pie',
				'echarts/chart/funnel'
				],

				/**** Charts setup ****/
				function (ec, limitless) {
					/**** Initialize charts ****/
					var cursos_solicitados = ec.init(document.getElementById('cursos_solicitados'), limitless);
					var diplomados_solicitados = ec.init(document.getElementById('diplomados_solicitados'), limitless);
					var cursos_nosolicitados = ec.init(document.getElementById('cursos_nosolicitados'), limitless);
					var diplomados_nosolicitados = ec.init(document.getElementById('diplomados_nosolicitados'), limitless);

					/**** Cursos solicitados ****/
					cursos_solicitados_options = {
						/**** Add title ****/
						title: {
							text: 'Cursos más solicitados',
							x: 'center'
						},

						/**** Add tooltip ****/
						tooltip: {
							trigger: 'item',
							formatter: "{a} <br/>{b}: {c} ({d}%)"
						},

						/**** Add legend ****/
						legend: {
							orient: 'vertical',
							x: 'left',
							data: [
							@foreach($cursosMasSolicitados as $cms)
								'{{ $cms->nombre }}',
							@endforeach
							]
						},

						/**** Enable drag recalculate ****/
						calculable: false,

						/**** Add series ****/
						series: [{
							name: 'Cursos',
							type: 'pie',
							radius: '80%',
							center: ['50%', '57.5%'],
							data: [
							@foreach($cursosMasSolicitados as $cms)
							{value: {{ $cms->cantidad }}, name: '{{ $cms->nombre }}'},
							@endforeach
							]
						}]
					};

					/**** Diplomados solicitados ****/
					diplomados_solicitados_options = {
						/**** Add title ****/
						title: {
							text: 'Diplomados más solicitados',
							x: 'center'
						},

						/**** Add legend ****/
						legend: {
							orient: 'vertical',
							x: 'left',
							data: [
								@foreach($diplomadosMasSolicitados as $dms)
								'{{ $dms->nombre }}',
								@endforeach
							]
						},

						/**** Enable drag recalculate ****/
						calculable: false,

						/**** Add series ****/
						series: [
						{
							name: 'Diplomados',
							type: 'pie',
							radius: ['50%', '70%'],
							center: ['50%', '57.5%'],
							itemStyle: {
								normal: {
									label: {
										show: true
									},
									labelLine: {
										show: true
									}
								},
								emphasis: {
									label: {
										show: true,
										formatter: '{b}' + '\n\n' + '{c} ({d}%)',
										position: 'center',
										textStyle: {
											fontSize: '17',
											fontWeight: '500'
										}
									}
								}
							},
							data: [
							@foreach($diplomadosMasSolicitados as $dms)
							{value: {{ $dms->cantidad }}, name: '{{ $dms->nombre }}'},
							@endforeach
							]
						}
						]
					};

					/**** Cursos menos solicitados ****/
					cursos_nosolicitados_options = {
						/**** Add title ****/
						title: {
							text: 'Cursos menos solicitados',
							x: 'center'
						},

						/**** Add tooltip ****/
						tooltip: {
							trigger: 'item',
							formatter: "{a} <br/>{b}: {c} ({d}%)"
						},

						/**** Add legend ****/
						legend: {
							orient: 'vertical',
							x: 'left',
							data: [
							@foreach($cursosMenosSolicitados as $cms)
								'{{ $cms->nombre }}',
							@endforeach
							]
						},

						/**** Enable drag recalculate ****/
						calculable: false,

						/**** Add series ****/
						series: [{
							name: 'Cursos',
							type: 'pie',
							radius: '80%',
							center: ['50%', '57.5%'],
							data: [
							@foreach($cursosMenosSolicitados as $cms)
							{value: {{ $cms->cantidad }}, name: '{{ $cms->nombre }}'},
							@endforeach
							]
						}]
					};

					/**** Diplomados solicitados ****/
					diplomados_nosolicitados_options = {
						/**** Add title ****/
						title: {
							text: 'Diplomados menos solicitados',
							x: 'center'
						},

						/**** Add legend ****/
						legend: {
							orient: 'vertical',
							x: 'left',
							data: [
								@foreach($diplomadosMenosSolicitados as $dms)
								'{{ $dms->nombre }}',
								@endforeach
							]
						},

						/**** Enable drag recalculate ****/
						calculable: false,

						/**** Add series ****/
						series: [
						{
							name: 'Diplomados',
							type: 'pie',
							radius: ['50%', '70%'],
							center: ['50%', '57.5%'],
							itemStyle: {
								normal: {
									label: {
										show: true
									},
									labelLine: {
										show: true
									}
								},
								emphasis: {
									label: {
										show: true,
										formatter: '{b}' + '\n\n' + '{c} ({d}%)',
										position: 'center',
										textStyle: {
											fontSize: '17',
											fontWeight: '500'
										}
									}
								}
							},
							data: [
							@foreach($diplomadosMenosSolicitados as $dms)
							{value: {{ $dms->cantidad }}, name: '{{ $dms->nombre }}'},
							@endforeach
							]
						}
						]
					};

					/**** Apply options ****/
					cursos_solicitados.setOption(cursos_solicitados_options);
					diplomados_solicitados.setOption(diplomados_solicitados_options);
					cursos_nosolicitados.setOption(cursos_nosolicitados_options);
					diplomados_nosolicitados.setOption(diplomados_nosolicitados_options);

					/**** Resize charts ****/
					window.onresize = function () {
						setTimeout(function (){
							cursos_solicitados.resize();
							diplomados_solicitados.resize();
							cursos_nosolicitados.resize();
							diplomados_nosolicitados.resize();
						}, 200);
					}
				}
			);
		});
	</script>
@stop

@section('contenido')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-flat">
				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="cursos_solicitados"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-flat">
				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="diplomados_solicitados"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-flat">
				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="cursos_nosolicitados"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-flat">
				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="diplomados_nosolicitados"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop