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


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){



    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function(){

        Route::get('/','WelcomeController@index')->name('index');

        Route::resource('users','UserController')->except(['show']);
        Route::resource('categories','CategoryController')->except(['show']);
        Route::resource('products','ProductController')->except(['show']);
        Route::resource('clients','ClientController')->except(['show']);
        Route::resource('clients.order','Clients\OrderController')->except(['show']);
        Route::resource('orders','OrderController')->except(['show']);
        Route::get('orders/{order}/products','OrderController@products')->name('orders.products');

    });
});


