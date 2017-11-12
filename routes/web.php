<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('ibeacon','iBeacon_guidance@index');
Route::post('ibeacon','iBeacon_guidance@create');
Route::put('ibeacon/{id}','iBeacon_guidance@update');
Route::delete('ibeacon/{id}','iBeacon_guidance@delete');
Route::get('ibeacon/{id}','iBeacon_guidance@ajax_getData');

