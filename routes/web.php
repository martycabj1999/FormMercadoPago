<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PaymentMethodsController@index')->name('payment');
Route::post('/payments/pay', 'PaymentMethodsController@pay')->name('pay');
Route::post('/payments/approval', 'PaymentMethodsController@approval')->name('approval');
Route::post('/payments/cancelled', 'PaymentMethodsController@cancelled')->name('cancelled');
