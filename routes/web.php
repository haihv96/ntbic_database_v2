<?php

use Elasticsearch\ClientBuilder;

Route::group(['prefix' => 'management', 'namespace' => 'Management'], function () {
    Route::resource('dashboards', 'DashboardController', ['only' => 'index']);
    Route::resource('raw-profiles', 'RawProfileController');
    Route::post('raw-profiles/transfer/{ids}', 'RawProfileController@transfer')->name('raw-profiles.transfer');
    Route::resource('raw-companies', 'RawCompanyController');
    Route::post('raw-companies/transfer/{ids}', 'RawCompanyController@transfer')->name('raw-companies.transfer');
    Route::resource('raw-products', 'RawProductController');
    Route::post('raw-products/transfer/{ids}', 'RawProductController@transfer')->name('raw-products.transfer');
    Route::resource('raw-patents', 'RawPatentController');
    Route::post('raw-patents/transfer/{ids}', 'RawPatentController@transfer')->name('raw-patents.transfer');
    Route::resource('raw-projects', 'RawProjectController');
    Route::post('raw-projects/transfer/{ids}', 'RawProjectController@transfer')->name('raw-projects.transfer');
    Route::resource('profiles', 'ProfileController');
    Route::resource('patents', 'PatentController');
    Route::resource('projects', 'ProjectController');
    Route::resource('products', 'ProductController');
    Route::resource('companies', 'CompanyController');
});

Route::get('test', function(){
    $params = [
        'index' => 'profiles',
        'type' => 'profiles',
        'body' => [
            'query' => [
                'match' => [
                    'name' => 'kim ánh'
                ]
            ]
        ]
    ];

    $results = ClientBuilder::create()->build()->search($params);
    dd($results);
});