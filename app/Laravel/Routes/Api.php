<?php

Route::group(['as' => "api.", 'prefix' => "api", 'namespace' => "Api", 'middleware' => ["api"]], function(){
    Route::get('/', function(){
        return response()->json(['message' => 'Test response text']);
    });
});