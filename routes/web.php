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
Route::get('/', function() {
    //$pdf = App::make('dompdf.wrapper');

    $pdf = app('dompdf.wrapper');

    $pdf -> loadHTML('<h1>Hola, putas. Estoy en helper APP</h1>');

    return $pdf -> stream();
});

Route::post('/donador/fetch', 'DonanteController@fetch')->name('donante.fetch');

Route::resource('donador', 'DonanteController');

//Route::view('/avisoprivacidad', 'aviso'); 

Route::prefix('content')->group(function () {
    Route::view('/', 'contenido/index'); //Dashboard
    Route::view('/buscador', 'contenido/buscador'); //Buscador
    Route::view('/reportes', 'contenido/reporte'); //Reportes de Excel. Sólo aplica a Organos
    Route::view('/estadisticas', 'contenido/graficas'); //Muestra las gráficas. Sólo aplica a Organos
    Route::view('/buscador', 'contenido/buscador'); 
});

//Route::get('buscador', [BuscadorController::class, 'index']);
//Route::post('buscador', [BuscadorController::class, 'buscar']);

Route::get('buscador', 'BuscadorController@index');
Route::post('buscador', 'BuscadorController@buscar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
