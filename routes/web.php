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

Route::get('/', 'HomeController@index');

Route::get('/news', 'NewsController@index');

Route::get('/manufacturer', 'ManufacturerController@index');
Route::get('/manufacturer/viewProducts/{manufacturerId}', 'ManufacturerController@viewProduct');

Route::get('/about', 'AboutController@index');

Route::get('/agreement', 'AgreementController@index');

Route::get('/catalog', 'CatalogController@index');
Route::get('/catalog/product/{id}', 'ProductController@index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
