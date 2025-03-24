<?php

Route::group(['as' => "api.", 'prefix' => "api", 'namespace' => "Api", 'middleware' => ["api"]], function(){
    include_once app_path('Laravel/Routes/Backoffice/Backoffice.php');
});