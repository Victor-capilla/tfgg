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

Route::get('/' , 'controladora@entrada');
// Route::get('/cuenta','controladora@meterseperfil');
Route::patch('/perfil', 'controladora@modificarperfil');
Route::delete('/perfil', 'controladora@eliminarperfil');
Route::get('/perfil', 'controladora@logueado');
Route::post('/perfil', 'controladora@subirfoto');
Route::put('/perfil', 'controladora@cambiarfoto');
Route::view('/login', 'login');
Route::get('/foro', 'controladora@foro');
Route::get('/foro/{nombre}', 'controladora@foronombres' );
Route::get('/foro/{foronombre}/temas/{nombre}', 'controladora@temas' );
Route::view('/registro', 'singUp');
Route::post('/singUp', 'controladora@registrocompletado');
Route::post('/foro/{foronombre}/temas/{nombre}', 'controladora@crearmensaje');
Route::put('/foro/{foronombre}/temas/{nombre}/{id}', 'controladora@modificarmensaje');
Route::delete('/foro/{foronombre}/temas/{nombre}/{id}', 'controladora@eliminarmensaje');
Route::post('/foro/{nombre}', 'controladora@creartema');
Route::put('/foro/{nombre}/{id}', 'controladora@modificartema');
Route::delete('/foro/{nombre}/{id}', 'controladora@eliminartema');
Route::get('/logout', 'controladora@logout');
Route::view('/prueba','prueba');
Route::view('/loquesea','loquesea');