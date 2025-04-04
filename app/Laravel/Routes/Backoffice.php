<?php

Route::group(['prefix' => "backoffice", 'as' => "backoffice.", 'middleware' => ["web"]], function () {
    Route::get('/{any?}', function () {
        return view('backoffice.index');
    })->where('any', '.*');
});