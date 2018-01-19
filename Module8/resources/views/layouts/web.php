<?php

Route::get('/', function () { return view('function/home');});

Route::get('/home','FunctionController@home');

Route::get('/gallery','PostController@gallery');

Route::get('/learn','LearnController@show');

Route::get('/contact','FunctionController@contact');

Route::get('/classify','FunctionController@classify');

Route::get('/register', 'AuthController@register');

Route::get('/login', 'AuthController@login');

Route::resource('posts','PostController');


//Route::get('posts/create', 'PostController@create');
//Route::post('posts', 'PostController@store');

Auth::routes();

//Route::get('/home', 'HomeController@index');

	Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
	Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
	Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
	Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
	Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

?>