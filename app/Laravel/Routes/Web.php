<?php

Route::group(['middleware' => 'web'], function () {
    Route::get('/backoffice/{any?}', function () {
        return view('backoffice.index');
    })->where('any', '.*');
});