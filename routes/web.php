<?php

Route::get('/', 'HomeController@index');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/users')->middleware('auth')->group(function(){

    Route::get('', 'UserController@index')->name('users.index')->middleware('check.ability:edit_users');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit')->middleware('check.ability:edit_users');;
    Route::post('/edit/{id}', 'UserController@update')->name('users.update');
    Route::get('/create', 'UserController@create')->name('users.create')->middleware('check.ability:edit_users');;
    Route::post('/create', 'UserController@store')->name('users.store')->middleware('check.ability:edit_users');;

});

Route::prefix('/groups')->middleware('auth')->group(function() {
    Route::get('', 'GroupController@index')->name('groups.index')->middleware('check.ability:edit_groups');;
    Route::get('/create','GroupController@create')->name('groups.create')->middleware('check.ability:edit_groups');;;
    Route::post('/create', 'GroupController@store')->name('groups.store')->middleware('check.ability:edit_groups');;;
    Route::get('/edit/{id}','GroupController@edit')->name('groups.edit')->middleware('check.ability:edit_groups');;;
    Route::post('/edit/{id}', 'GroupController@update')->name('groups.update')->middleware('check.ability:edit_groups');;;
    Route::post('/addmember/{group_id}', 'GroupController@addGroupMember')->name('groups.addmember')->middleware('check.ability:edit_groups');;;
});

Route::prefix('/mail')->middleware('auth')->group(function(){
   Route::get('/create','MailController@createFromQuery')->name('mail.create')->middleware('check.ability:send_email');;;
   Route::post('/create', 'MailController@sendMail')->name('mail.send')->middleware('check.ability:send_email');;;
});
