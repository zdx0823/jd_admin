<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['checkAuth'])->group(function () {

    Route::get('/', 'StaticPageController@index')->name('pageIndex');

});


Route::get('/test', 'StaticPageController@test');
Route::get('/confirm', 'StaticPageController@confirm')->name('pageConfirm');

Route::post('/logout/sso', 'SessionController@ssoLogout')->name('ssoLogout');