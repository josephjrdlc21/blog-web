<?php

Route::group(['as' => "auth."], function(){
    Route::post('login', ['as' => "login", 'uses' => "AuthenticateController@authenticate"]);

    Route::group(['middleware' => "api.auth:api"], function () {
        Route::post('logout', ['as' => "logout", 'uses' => "AuthenticateController@logout"]);
    });
});