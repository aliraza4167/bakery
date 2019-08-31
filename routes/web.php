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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('home');
})->middleware('auth');

Route::resource('/products', 'ProductController')->middleware('auth');
Route::resource('/promotions', 'PromotionController')->middleware('auth');
Route::resource('/custom_orders', 'CustomOrderController')->middleware('auth');

Route::post('products/{product_id}/promotion', 'ProductPromotionController@store')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('/userlocations', 'UserLocationController')->middleware('auth');

// MESSAGES ROUTE
Route::resource('/messages', 'MessagesController')->middleware('auth');