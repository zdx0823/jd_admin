<?php

use Illuminate\Support\Facades\Route;


Route::get('/test', 'StaticPageController@test');
Route::get('/', 'StaticPageController@index')->name('pageIndex');
Route::get('/confirm', 'StaticPageController@confirm')->name('pageConfirm');

Route::post('/api/confirmCode', 'MainController@confirmCode')->name('api_confirmCode');
