<?php

Route::get('/', 'HomeController@index');

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/users')->middleware('auth')->group(function(){

    Route::get('', 'UserController@index')->name('users.index')->middleware('check.ability:edit_users');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit')->middleware('check.ability:edit_users');
    Route::post('/edit/{id}', 'UserController@update')->name('users.update');
    Route::get('/create', 'UserController@create')->name('users.create')->middleware('check.ability:edit_users');
    Route::post('/create', 'UserController@store')->name('users.store')->middleware('check.ability:edit_users');

});


Route::prefix('/groups')->middleware('auth')->group(function() {
    Route::get('', 'GroupController@index')->name('groups.index')->middleware('check.ability:edit_groups');
    Route::get('/create','GroupController@create')->name('groups.create')->middleware('check.ability:edit_groups');
    Route::post('/create', 'GroupController@store')->name('groups.store')->middleware('check.ability:edit_groups');
    Route::get('/edit/{id}','GroupController@edit')->name('groups.edit')->middleware('check.ability:edit_groups');
    Route::post('/edit/{id}', 'GroupController@update')->name('groups.update')->middleware('check.ability:edit_groups');
    Route::post('/addmember/{group_id}', 'GroupController@addGroupMember')->name('groups.addmember')->middleware('check.ability:edit_groups');
    Route::get('/removemember/{group_id}/{user_id}', 'GroupController@removeGroupMember')->name('groups.removemember')->middleware('check.ability:edit_groups');
});

Route::prefix('/mail')->middleware('auth')->group(function(){
   Route::get('/create','MailController@createFromQuery')->name('mail.create')->middleware('check.ability:send_email');
   Route::post('/create', 'MailController@sendMail')->name('mail.send')->middleware('check.ability:send_email');
});

Route::prefix('/event')->middleware('auth')->group(function(){
    Route::get('', 'EventController@index')->name('events.index');
    Route::get('/{id}','EventController@show')->name('events.show');
    Route::get('/edit/{id}', 'EventController@edit')->name('events.edit')->middleware('check.ability:edit_events');
    Route::post('/edit/{id}', 'EventController@update')->name('events.update')->middleware('check.ability:edit_events');
    Route::get('/create', 'EventController@create')->name('events.create')->middleware('check.ability:edit_events');
    Route::post('/create', 'EventController@store')->name('events.store')->middleware('check.ability:edit_events');
    Route::get('/delete/{id}', 'EventController@confirmDelete')->name('events.confirmDelete')->middleware('check.ability:delete_events');
    Route::delete('/delete/{id}', 'EventController@delete')->name('events.delete')->middleware('check.ability:delete_events');
    Route::get('/signup/{id}', 'EventController@signup')->name('events.signup');
    Route::get('/cancelSignup/{id}','EventController@cancelSignup')->name('events.cancelSignup');
});

Route::prefix('/payment')->middleware('auth')->group(function() {
    Route::get('', 'PaymentController@index')->name('payments.index')->middleware('check.ability:edit_payments');
    Route::get('/myPayments', 'PaymentController@myPayments')->name('payments.myPayments');
    Route::post('/pay/{id}', 'PaymentController@pay')->name('payments.pay');
    Route::get('/pay/{id}', 'PaymentController@paymentInstruction')->name('payments.paymentInstruction');
    
});

Route::prefix('/memberfee')->middleware('auth')->group(function() {
    Route::get('', 'MemberFeeController@index')->name('memberfees.index')->middleware('check.ability:edit_memberfees');
    Route::get('/create', 'MemberFeeController@create')->name('memberfees.create')->middleware('check.ability:edit_memberfees');
    Route::post('/create', 'MemberFeeController@store')->name('memberfees.store')->middleware('check.ability:edit_memberfees');
});