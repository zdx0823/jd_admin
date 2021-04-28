<?php

use Illuminate\Support\Facades\Route;


Route::get('/test', 'StaticPageController@test');
Route::get('/', 'StaticPageController@index')->name('pageIndex');
