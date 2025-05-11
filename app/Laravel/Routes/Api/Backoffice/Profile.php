<?php

Route::group(['as' => "profile.", 'prefix' => "profile"], function(){
    Route::get('/', ['as' => "index", 'uses' => "ProfileController@index"]);
    Route::post('edit', ['as' => "update", 'uses' => "ProfileController@update"]);
    Route::post('edit-password', ['as' => "update_password", 'uses' => "ProfileController@update_password"]);
});