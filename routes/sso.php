<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'SsoController@login')->name('sso.login_form');
    Route::post('make-request', 'SsoController@makeRequest')->name('sso.login');
});
Route::get('logout', 'SsoController@destroySession');
Route::get('set-session/{ssoTicketSecret}', 'SsoController@setSession');
