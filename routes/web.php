<?php

Route::get('/', 'HomeController@index');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/users')->middleware('auth')->group(function(){

    Route::get('', 'UserController@index')->name('users.index')->middleware('edit.users');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit')->middleware('edit.users');;
    Route::post('/edit/{id}', 'UserController@update')->name('users.update');
    Route::get('/create', 'UserController@create')->name('users.create')->middleware('edit.users');;
    Route::post('/create', 'UserController@store')->name('users.store')->middleware('edit.users');;

});

