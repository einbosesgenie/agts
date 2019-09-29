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
Route::get('/news/typeView/{id}', 'NewsController@typeView');
Route::get('/news/view/{id}', 'NewsController@view');

Route::get('/manufacturer', 'ManufacturerController@index');
Route::get('/manufacturer/viewProducts/{manufacturerId}', 'ManufacturerController@viewProduct');

Route::get('/about', 'AboutController@index');

Route::get('/agreement', 'AgreementController@index');

Route::get('/catalog', 'CatalogController@index');
Route::get('/catalog/category/{id}', 'CatalogController@viewCategory');

Route::get('/catalog/product/{id}', 'ProductController@index');
Route::get('/catalog/product/view/{id}', 'ProductController@viewProduct');

Route::get('/contact', 'ContactController@index');
Route::get('/contact/indexView/{id}', 'ContactController@indexView');

Route::get('/contact/feedback', 'ContactController@feedback');
Route::post('/contacts/feedbackSave', 'ContactController@save');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
