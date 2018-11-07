<?php

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')
->group(function () {
	Route::get('/products', 'ProductController@index'); // lista
	Route::get('/products/create', 'ProductController@create'); // formulario
	Route::post('/products', 'ProductController@store'); // registrar
	Route::get('/products/{id}/edit', 'ProductController@edit'); // formulario edição
	Route::post('/products/{id}/edit', 'ProductController@update'); // atualizar
	Route::delete('/products/{id}', 'ProductController@destroy'); // form eliminar

	Route::get('/products/{id}/images', 'ImageController@index'); // lista
	Route::post('/products/{id}/images', 'ImageController@store'); // registrar
	Route::delete('/products/{id}/images', 'ImageController@destroy'); // form eliminar	
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); // destacar

	Route::get('/categories', 'CategoryController@index'); // lista
	Route::get('/categories/create', 'CategoryController@create'); // formulario
	Route::post('/categories', 'CategoryController@store'); // registrar
	Route::get('/categories/{category}/edit', 'CategoryController@edit'); // formulario edição
	Route::post('/categories/{category}/edit', 'CategoryController@update'); // atualizar
	Route::delete('/categories/{category}', 'CategoryController@destroy'); // form eliminar
});
