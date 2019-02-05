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

Route::get('/', function () {
    return view('welcome');
});

/*
    De forma general, a modo de controlador de recurso
*//*
////Route::resource('posts', 'PostController');
Route::resource('posts', 'PostController')->only([
    'index', 'show'
]);

Route::resource('users', 'UserController')->only([
    'index', 'show'
]);*/

Route::get('/posts/lista/{accion?}', 'PostController@index')
    ->name('posts_lista');
Route::get('/posts/detalle/{id}', 'PostController@show')
    ->name('posts_detalle');

Route::post('/posts/insertar', 'PostController@store')
    ->name('posts_insertar');

Route::post('/posts/editar', 'PostController@update')
    ->name('posts_editar');
Route::get('/posts/editar/{id}/{campo}/{valor}', 'PostController@update_campo')
    ->name('posts_editar_campo');

Route::get('/posts/borrar/{id}', 'PostController@destroy')
    ->name('posts_borrar');

// --------------------------------------------------------------------------

Route::get('/users/lista/{accion?}', 'UserController@index')
    ->name('users_lista');
Route::get('/users/detalle/{id}', 'UserController@show')
    ->name('users_detalle');

Route::post('/users/insertar', 'UserController@store')
    ->name('users_insertar');

Route::post('/users/editar', 'UserController@update')
    ->name('users_editar');
Route::get('/users/editar/{id}/{campo}/{valor}', 'UserController@update_campo')
    ->name('users_editar_campo');

Route::get('/users/borrar/{id}', 'UserController@destroy')
    ->name('users_borrar');

// --------------------------------------------------------------------------

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
