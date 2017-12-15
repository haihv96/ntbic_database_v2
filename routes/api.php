<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function () {
    Route::resource('raw-profiles', 'RawProfileController');
});