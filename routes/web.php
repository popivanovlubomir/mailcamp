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

Route::get('/', 'CampaignsController@index');

Route::get('/campaigns', 'CampaignsController@index')->name('listcampaigns');
Route::get('/campaigns/create', 'CampaignsController@create')->name('createcampaign');
Route::get('/campaigns/view/{id}', 'CampaignsController@show')->name('viewcampaign');
Route::post('/campaigns/store', 'CampaignsController@store')->name('savecampaign');

Route::get('/test', 'TestController@index');