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

// use Symfony\Component\Routing\Route;

use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\ReporteController;


//07/05/2026-> Primero haremos el xlsx y luego el PDF
//Librerías: DOMPDF y maatwebsite 

// Route::get('/', function() {
//     //$pdf = App::make('dompdf.wrapper');

//     $pdf = app('dompdf.wrapper');

//     $pdf -> loadHTML('<h1>Hola, putas. Estoy en helper APP</h1>');

//     return $pdf -> stream();
// });

Route::post('/donador/fetch', 'DonanteController@fetch')->name('donante.fetch');
Route::post('content/reporte/fetch', 'ReporteController@fetch')->name('reporte.fetch');
Route::post('content/buscador/fetch', 'BuscadorController@fetch')->name('buscador.fetch');

Route::resource('donador', 'DonanteController');
Route::resource('user', 'UserController');

//Route::view('/avisoprivacidad', 'aviso'); 

Route::prefix('content')->group(function () {
    Route::view('/', 'contenido/dashboard'); //Dashboard
    Route::view('/buscador', 'contenido/buscador'); //Buscador
    Route::view('/reporte', 'contenido/reporte'); //Reportes de Excel. Sólo aplica a Organos
    //Route::view('/estadisticas', 'contenido/graficas'); //Muestra las gráficas. Sólo aplica a Organos
    Route::view('/buscador', 'contenido/buscador'); 
});

Route::get('content/buscador', 'BuscadorController@index')->name('buscador.index');
Route::post('content/buscador', 'BuscadorController@buscar');

Route::get('content/reporte', 'ReporteController@index')->name('reporte.index');
// Route::post('content/reporte-import', 'ReporteController@import')->name('reporte.import');
Route::get('content/reporte-export', 'ReporteController@export')->name('reporte.export');

Route::get('content/estadisticas', 'GraficasController@verGraficas')->name('estadisticas.verGraficas'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
