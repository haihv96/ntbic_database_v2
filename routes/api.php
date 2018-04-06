<?php

Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function () {
        Route::resource('profiles', 'ProfileController');
        Route::get('profiles/query/top', 'ProfileController@getTop');
        Route::resource('projects', 'ProjectController');
        Route::resource('patents', 'PatentController');
        Route::resource('companies', 'CompanyController');
        Route::resource('products', 'ProductController');
        Route::resource('academic-titles', 'AcademicTitleController', ['only' => ['index']]);
        Route::resource('provinces', 'ProvinceController', ['only' => ['index']]);
        Route::resource('patent-types', 'PatentTypeController', ['only' => ['index']]);
        Route::resource('specializations', 'SpecializationController', ['only' => ['index']]);
        Route::resource('base-technology-categories', 'BaseTechnologyCategoryController', ['only' => ['index']]);
        Route::get('analysis', 'AnalysisController@index');
    });
});
