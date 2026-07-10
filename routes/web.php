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


use Illuminate\Support\Facades\Route;

Route::post('/donador/fetch', 'DonanteController@fetch')->name('donante.fetch');
Route::post('content/reporte/fetch', 'ReporteController@fetch')->name('reporte.fetch');
Route::post('content/buscador/fetch', 'BuscadorController@fetch')->name('buscador.fetch');

Route::view('/credencial', 'credencial')->name('donante.credencial'); 

Route::get('donador/create', 'DonanteController@create')->name('donador.create');
Route::post('donador', 'DonanteController@store')->name('donador.store');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@login')->name('login.post');
Route::post('/logout', 'AuthController@logout')->name('logout');

Route::get('denegado', function () {
    return view('denegado');
})->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('user/restore/{id}', 'UserController@restore')->name('user.restore');
    Route::resource('user', 'UserController');
    Route::resource('donador', 'DonanteController')->except(['create', 'store']);
    
    
    Route::prefix('content')->group(function () {
        Route::view('/', 'contenido/dashboard')->name('content'); 
        Route::get('buscador', 'BuscadorController@index')
            ->name('buscador.index');
        Route::post('buscador', 'BuscadorController@buscar');
        Route::get('reporte', 'ReporteController@index')
            ->name('reporte.index')
            ->middleware('role:Administrador|developer|Reporteador');
        Route::get('reporte-export', 'ReporteController@export')
            ->name('reporte.export');
        Route::get('reporte-users', 'UsersReporteController@index')
            ->name('reporteUser.index')
            ->middleware('role:Administrador|developer');
        Route::get('reporte-users-export', 'UsersReporteController@export')
            ->name('reporteUser.export');
        Route::get('estadisticas', 'GraficasController@verGraficas')
            ->name('estadisticas.verGraficas');
        Route::get('estadisticas/organos-por-lugar', 'GraficasController@getOrganosPorLugar')
            ->name('estadisticas.organosLugar');
        Route::get('novedades', 'AuditoriasController@index')
            ->name('novedades.index')
            ->middleware('role:Administrador|developer');
    });
});
