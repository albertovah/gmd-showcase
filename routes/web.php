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

Auth::routes();

/*frontend routes*/
Route::any('/', 'productFrontendController@Search');
Route::get('/', 'productFrontendController@index');
Route::get('/product/{product}','productFrontendController@show');
Route::get('/home', 'HomeController@index');

/*producten*/
Route::get('/backend/product/create', 'productController@create');
Route::get('/backend/product/{product}/edit', 'productController@edit');
Route::put('/backend/product/{product}/update', 'productController@update');
Route::get('/backend/product/{product}/delete', 'productController@destroy');
Route::get('/backend/product/show/{product}','productController@show');
Route::post('/backend/product/save', 'productController@store');
Route::any('/backend/product', 'productController@search');
Route::get('/backend/product', 'productController@index');

/*modules*/
Route::get('/backend/module/create', 'moduleController@create');
Route::get('/backend/module/{module}/edit', 'moduleController@edit');
Route::put('/backend/module/{module}/update', 'moduleController@update');
Route::get('/backend/module/{module}/delete', 'moduleController@destroy');
Route::post('/backend/module', 'moduleController@store');
Route::get('/backend/module', 'moduleController@index');

/*categorien*/
Route::get('/backend/categorie/create', 'categorieController@create');
Route::get('/backend/categorie/{categorie}/edit', 'categorieController@edit');
Route::put('/backend/categorie/{categorie}/update', 'categorieController@update');
Route::get('/backend/categorie/{categorie}/delete', 'categorieController@destroy');
Route::post('/backend/categorie', 'categorieController@store');
Route::get('/backend/categorie', 'categorieController@index');

/*gebruikers*///alleen voor adminstrators
Route::get('/backend/gebruiker/create', 'gebruikerController@create');
Route::get('/backend/gebruiker/{user}/edit','gebruikerController@edit');
Route::put('/backend/gebruiker/{user}/update', 'gebruikerController@update');
Route::put('/backend/gebruiker/{user}/updateAdminTrue', 'gebruikerController@updateAdminTrue');
Route::put('/backend/gebruiker/{user}/updateAdminFalse', 'gebruikerController@updateAdminFalse');
Route::get('/backend/gebruiker/{user}/delete', 'gebruikerController@destroy');
Route::post('/backend/gebruiker','gebruikerController@store');
Route::get('/backend/gebruiker','gebruikerController@index');
