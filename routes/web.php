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
    //return view('welcome');
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('ibeacon','iBeacon_guidance@index');
    Route::post('ibeacon','iBeacon_guidance@create');
    Route::patch('ibeacon/{id}','iBeacon_guidance@update');
    Route::delete('ibeacon/{id}','iBeacon_guidance@delete');
    Route::get('ibeacon/{id}','iBeacon_guidance@ajax_getData');
    Route::get('users','UserController@index');
    Route::post('users','UserController@create');
    Route::patch('users/{id}','UserController@update');
    Route::delete('users/{id}', 'UserController@delete');
    Route::patch('users/password/{id}','UserController@reset_password');
    Route::get('users/{id}','UserController@ajax_get_data');
    Route::get('website','WebinfoController@getWebinfo');
    Route::patch('website','WebinfoController@update');
});
/*
Route::get('home',function(){
    return redirect('users');
});
*/
Route::post('login','AuthController@auth');
Route::get('login','AuthController@login');
Route::get('logout','AuthController@logout');







