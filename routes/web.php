<?php

Route::group(['prefix' => 'management', 'namespace' => 'Management'], function () {
    Route::resource('dashboards', 'DashboardController', ['only' => 'index']);
    Route::resource('raw-profiles', 'RawProfileController');
    Route::resource('raw-companies', 'RawCompanyController');
    Route::resource('raw-products', 'RawProductController');
    Route::resource('raw-patents', 'RawPatentController');
    Route::resource('raw-projects', 'RawProjectController');
});
