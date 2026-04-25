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

Route::view('/avisoprivacidad', 'aviso');