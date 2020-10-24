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

use Illuminate\Support\Facades\Route;
// Route::get('/', function () {
//     return view('shop.layouts.main');
// });

Route::get('/', 'ShopController@index')->name('home');


// Route::get('admin/search', 'AdminController@search')->name('search');

Route::get('/tim-kiem', 'ShopController@searchTour')->name('shop.search');

Route::get('/categories', 'ShopController@getListCategories')->name('shop.list-categories');

Route::get('/chi-tiet-tour/{slug}_{id}', 'ShopController@getTourDetail')->name('shop.tour-detail');

// Route::get('/sort/{request}', 'ShopController@sortTours')->name('shop.tour');
Route::get('/categories/sort', 'ShopController@sortTours');

Route::get('/categories/{slug}', 'ShopController@getListTour')->name('shop.tour');

Route::get('/contact', 'ShopController@contact')->name('shop.contact');

Route::post('/contact', 'ShopController@getContact')->name('shop.contactRequest');

// Route::get('/categories/{slug}')

Route::get('/thanh-toan-tour/{slug}_{id}', 'OrderTourController@getOrder')->name('shop.order');

Route::post('/thanh-toan-tour', 'OrderTourController@storeOrder')->name('shop.checkout');

// Route::get('/thanh-toan-tour/update', 'OrderTourController@updateOrder')->name('shop.order');
// Route::get('/thanh-toan');

// Route::get('/categories/{slug}', 'ShopController@getListCategories')->name('shop.list-categories');

Route::get('/pass_forgot', 'Auth\ForgotPasswordController@index')->name('passForgot');
Route::get('/check_code', 'Auth\ForgotPasswordController@checkCode');

Route::post('/check_email', 'Auth\ForgotPasswordController@checkEmail');
Route::post('/reset_password', 'Auth\ForgotPasswordController@resetPassword')->name('resetPassword');
Route::post('/new_password', 'Auth\ForgotPasswordController@newPassword');

Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/postLogin', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'checkLogin'], function () {
    Route::get('admin/category/search', 'AdminController@searchCategory')->name('category.search');
    Route::get('admin/tour/search', 'AdminController@searchTour')->name('tour.search');

    Route::group([ 'prefix'  => 'admin',  'as' => 'admin.' ], function () {
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::resource('banner', 'BannerController');
        Route::resource('role', 'RoleController');
        Route::resource('category', 'CategoryController');
        Route::resource('tour', 'TourController');
        Route::resource('image', 'ImageController');
        Route::resource('transport', 'TransportController');
        Route::resource('position', 'PositionController');
        Route::resource('order', 'OrderController');
        Route::resource('setting', 'SettingController');
        Route::resource('user', 'UserController');
        Route::resource('contact', 'ContactController');
    });
});
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
