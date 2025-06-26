<?php

Route::group(['as' => "pages.", 'prefix' => "pages"], function(){
    Route::post('store', ['as' => "store", 'uses' => "PageController@store"]);
});