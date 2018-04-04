<?php

Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function () {
        Route::resource('profiles', 'ProfileController');
        Route::resource('projects', 'ProjectController');
        Route::resource('patents', 'PatentController');
        Route::resource('companies', 'CompanyController');
        Route::resource('products', 'ProductController');
    });
});
