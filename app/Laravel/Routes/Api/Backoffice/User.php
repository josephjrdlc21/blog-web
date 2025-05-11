<?php

Route::group(['as' => "users.", 'prefix' => "users"], function(){
    Route::get('/', ['as' => "index", 'uses' => "UserController@index"]);
    Route::post('store', ['as' => "store", 'uses' => "UserController@store"]);
    Route::get('edit/{id?}', ['as' => "edit", 'uses' => "UserController@edit"]);
    Route::get('edit-status/{id?}', ['as' => "update_status", 'uses' => "UserController@update_status"]);
    Route::get('edit-password/{id?}', ['as' => "update_password", 'uses' => "UserController@update_password"]);
    Route::post('update/{id?}', ['as' => "update", 'uses' => "UserController@update"]);
    Route::any('delete/{id?}', ['as' => "delete", 'uses' => "UserController@destroy"]);
    Route::get('show/{id?}', ['as' => "show", 'uses' => "UserController@show"]);
});