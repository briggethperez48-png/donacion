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

// Route::get('/donador/avisoprivacidad', function () {
//     return view('donante
//     ');
// });

Route::post('/donador/fetch', 'DonanteController@fetch')->name('donante.fetch');

Route::resource('donador', 'DonanteController');

//Route::view('/avisoprivacidad', 'aviso'); 

Route::prefix('content')->group(function () {
    Route::view('/', 'contenido/index'); //Dashboard
    Route::view('/buscador', 'contenido/buscador'); //Buscador
    Route::view('/reportes', 'contenido/reporte'); //Reportes de Excel
    Route::view('/control', 'contenido/graficas'); //Muestra las gráficas 
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
