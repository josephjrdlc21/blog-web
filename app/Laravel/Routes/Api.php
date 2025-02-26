<?php

Route::group(['as' => "api.", 'prefix' => "api", 'namespace' => "Api", 'middleware' => ["api"]], function(){
    Route::group(['as' => "users", 'prefix' => "users"], function(){
        Route::get('/', ['as' => "index", 'uses' => "UserController@index"]);
    });
});