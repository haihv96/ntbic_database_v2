<?php

Route::group(['prefix' => 'management', 'namespace' => 'Management'], function () {
    Route::resource('dashboards', 'DashboardController', ['only' => 'index']);
    Route::resource('raw-profiles', 'RawProfileController');
});
