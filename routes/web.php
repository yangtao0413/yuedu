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
    return view('Index/index');
});

 	Route::get('login/register','login\LoginController@register');
    Route::post('login/registerto','login\LoginController@registerto');
    Route::get('Login/login','login\LoginController@login');
    Route::post('Login/loginto','login\LoginController@loginto');
    Route::any('Index/index','login\IndexController@index');
    Route::any('index','login\IndexController@index');
    Route::get("login/quit","login\\LoginController@quit");//退出页面
