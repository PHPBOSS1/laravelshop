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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'  =>  'admin' ], function(){
    Route::get('/admin', 'AdminController@index');
    Route::get('/category/create ', 'AdminCategoriesController@create');
    Route::post("/categories/category/store", "AdminCategoriesController@store");
    Route::get("/categories", "AdminCategoriesController@index");
    Route::get('/products', 'AdminProductsController@index');
    Route::get('/product/create ', 'AdminProductsController@create');
    Route::post("/products/product/store", "AdminProductsController@store");
//            dd('stop');

    Route::get("/product/edit/{id}", "AdminProductsController@edit");
//            dd('stop');
    Route::post("/products/product/edit_store/{id}", "AdminProductsController@edit_store");
    //            dd('stop');

    Route::get("/products/product/delete/{id}", "AdminProductsController@destroy");

});

//Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function () {
//    Route::get('/admin', 'AdminController@index');
//});

//Route::get('/adminka', 'AdminkaController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
