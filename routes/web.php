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
Route::get('/goods', 'GoodsController@index');
Route::get('/add_good', 'GoodsController@add');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/exchange_rates', 'ExchangeRateController@index')->name('exchange_rates');

Route::get('/add_order', 'OrderController@showOrderForm');
Route::post('/add_order', 'OrderController@add')->name('add_order');
Route::post('/home','OrderController@exterminate')->name('exterminate_order');
Route::post('/home/manage','OrderController@manageOrder')->name('manage_order');
