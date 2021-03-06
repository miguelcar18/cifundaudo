<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'principal', 'uses' => 'BackController@index']);
Route::resource('usuarios', 'UserController');
Route::resource('clientes', 'ClientesController');
Route::resource('cursos', 'CursosController');
Route::resource('facturacionCursos', 'FacturacionCursosController');
Route::resource('facturacionDiplomados', 'FacturacionDiplomadosController');
Route::resource('cuentas-por-cobrar', 'CuentasCobrarController');
Auth::routes();
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('restaurar-contrasena', ['as' => 'change_password', 'uses' =>'LoginController@changePassword']);
Route::post('profile/change-password', ['as' => 'postChangePassword', 'uses' => 'LoginController@postChangePassword']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/buscarMontoCurso/{id}', ['as' => 'buscarMontoCurso', 'uses' => 'FacturacionCursosController@buscarMontoCurso']);
Route::get('factura-curso/{id}', ['as' => 'reporteFacturaCurso', 'uses' =>'FacturacionCursosController@reporteFactura']);
Route::get('factura-diplomado/{id}', ['as' => 'reporteFacturaDiplomado', 'uses' =>'FacturacionDiplomadosController@reporteFactura']);
Route::get('/reportes', ['as' => 'reportes', 'uses' => 'ReportesController@index']);
Route::post('/reportes', ['as' => 'resuldatosReportes', 'uses' =>'ReportesController@resultados']);
Route::get('/cargar-recibo-pago', ['as' => 'cargarReciboPago', 'uses' => 'BackController@cargarReciboPago']);
Route::post('/cargar-recibo-pago', ['as' => 'postCargarReciboPago', 'uses' =>'BackController@postCargarReciboPago']);
Route::get('/estadisticas', ['as' => 'estadisticas', 'uses' => 'ReportesController@estadisticas']);