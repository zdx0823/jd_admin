<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['checkLogin', 'checkTmpToken'])->group(function () {

    Route::get('/', 'StaticPageController@index')->name('pageIndex');

});


Route::get('/test', 'StaticPageController@test');
Route::get('/confirm', 'StaticPageController@confirm')
    ->middleware(['checkLogin'])
    ->name('pageConfirm');

Route::post('/confirm/send_code', 'SessionController@sendCode')->name('confirm_sendCode');
Route::post('/confirm/confirm', 'SessionController@confirmCode')->name('confirm_confirm');

Route::post('/logout/sso', 'SessionController@ssoLogout')->name('ssoLogout');

// 无权限界面
Route::get('/forbidden', 'StaticPageController@forbidden')->name('forbidden');