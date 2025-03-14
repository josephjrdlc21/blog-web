<?php

Route::group(['as' => "api.", 'prefix' => "api", 'namespace' => "Api", 'middleware' => ["api"]], function(){
    Route::group(['as' => "auth."], function(){
        Route::post('login', ['as' => "login", 'uses' => "AuthenticateController@authenticate"]);

        Route::group(['middleware' => "api.auth:api"], function () {
            Route::post('logout', ['as' => "logout", 'uses' => "AuthenticateController@logout"]);
        });
    });

    Route::group(['middleware' => "api.auth:api"], function(){
        Route::group(['as' => "users", 'prefix' => "users"], function(){
            Route::get('/', ['as' => "index", 'uses' => "UserController@index"]);
            Route::post('store', ['as' => "store", 'uses' => "UserController@store"]);
            Route::get('edit/{id?}', ['as' => "edit", 'uses' => "UserController@edit"]);
            Route::post('update/{id?}', ['as' => "update", 'uses' => "UserController@update"]);
            Route::any('delete/{id?}', ['as' => "delete", 'uses' => "UserController@destroy"]);
            Route::get('show/{id?}', ['as' => "show", 'uses' => "UserController@show"]);
        });
    });
});