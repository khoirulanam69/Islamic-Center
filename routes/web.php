<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'MainController@index');
Route::get('/jadwalsholat', 'MainController@jadwalsholat');
Route::post('/jadwalsholat', 'MainController@jadwalsholat');
Route::get('/alquran', 'MainController@alquran');
Route::get('/alquran/{id}', 'MainController@detailalquran');
Route::get('/kiblat', 'MainController@kiblat');
Route::get('/offline', 'MainController@offline');
