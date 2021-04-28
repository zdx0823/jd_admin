<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['checkLogin', 'checkTmpToken', 'pullUserInfo'])->group(function () {

    Route::get('/', 'StaticPageController@index')->name('pageIndex');

});


Route::get('/test', 'StaticPageController@test');
Route::get('/confirm', 'StaticPageController@confirm')
    ->middleware(['checkLogin', 'pullUserInfo'])
    ->name('pageConfirm');

Route::post('/confirm/send_code', 'SessionController@sendCode')->name('confirm_sendCode');

Route::post('/logout/sso', 'SessionController@ssoLogout')->name('ssoLogout');