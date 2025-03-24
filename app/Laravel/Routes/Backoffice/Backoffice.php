<?php

Route::group(['as' => "backoffice.", 'prefix' => "backoffice", 'namespace' => "Backoffice"], function(){
    include_once app_path('Laravel/Routes/Backoffice/Auth.php');

    Route::group(['middleware' => "api.auth:backoffice"], function(){
        include_once app_path('Laravel/Routes/Backoffice/User.php');
    });
});