<?php

Route::group(['as' => "api.", 'prefix' => "api", 'namespace' => "Api", 'middleware' => ["api"]], function(){
    Route::group(['as' => "backoffice.", 'prefix' => "backoffice", 'namespace' => "Backoffice"], function(){
        include_once app_path('Laravel/Routes/Api/Backoffice/Auth.php');

        Route::group(['middleware' => "api.auth:backoffice"], function(){
            include_once app_path('Laravel/Routes/Api/Backoffice/User.php');
        });
    });
});