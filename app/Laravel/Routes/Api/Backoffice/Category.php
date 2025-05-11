<?php

Route::group(['as' => "categories.", 'prefix' => "categories"], function(){
    Route::get('/', ['as' => "index", 'uses' => "CategoryController@index"]);
    Route::post('store', ['as' => "store", 'uses' => "CategoryController@store"]);
    Route::get('edit/{id?}', ['as' => "edit", 'uses' => "CategoryController@edit"]);
    Route::post('update/{id?}', ['as' => "update", 'uses' => "CategoryController@update"]);
    Route::any('delete/{id?}', ['as' => "delete", 'uses' => "CategoryController@destroy"]);
});