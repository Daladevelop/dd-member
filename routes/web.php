<?php

Route::get('/', 'HomeController@index');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/users')->middleware('auth')->group(function(){

    Route::get('', 'UserController@index')->name('users.index')->middleware('check.ability:edit.useraaaas');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit')->middleware('check.ability:edit.users');;
    Route::post('/edit/{id}', 'UserController@update')->name('users.update');
    Route::get('/create', 'UserController@create')->name('users.create')->middleware('check.ability:edit.users');;
    Route::post('/create', 'UserController@store')->name('users.store')->middleware('check.ability:edit.users');;

});

Route::prefix('/groups')->middleware('auth')->group(function() {
    Route::get('', 'GroupController@index')->name('groups.index');
    Route::get('/create','GroupController@create')->name('groups.create');
    Route::post('/create', 'GroupController@store')->name('groups.store');
    Route::get('/edit/{id}','GroupController@edit')->name('groups.edit');
    Route::post('/edit/{id}', 'GroupController@update')->name('groups.update');
    Route::post('/addmember/{group_id}', 'GroupController@addGroupMember')->name('groups.addmember');
});

