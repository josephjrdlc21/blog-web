<?php

Route::group(['as' => "categories", 'prefix' => "categories"], function(){
    Route::get('/', ['as' => "index", 'uses' => "CategoryController@index"]);
});