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

/* Campaigns routes */
Route::get('/campaigns', 'CampaignsController@index')->name('listcampaigns');
Route::get('/campaigns/create', 'CampaignsController@create')->name('createcampaign');
Route::get('/campaigns/view/{id}', 'CampaignsController@show')->name('viewcampaign');
Route::post('/campaigns/store', 'CampaignsController@store')->name('savecampaign');

/* Contacts lists routes */
Route::get('/contactslist', 'ContactsListsController@index')->name('contactslist');
Route::get('/contactslist/create', 'ContactsListsController@create')->name('createcontactslist');
Route::post('/contactslist/store', 'ContactsListsController@store')->name('savecontactslist');
Route::post('/contactslist/remove', 'ContactsListsController@destroy')->name('removecontactslistc');

/* Contacts routes*/
Route::get('/contactslist/{list_id}/contacts', 'ContactsController@index')->name('viewcontacts');
Route::get('/contactslist/{list_id}/contacts/create', 'ContactsController@create')->name('createcontact');
Route::post('/contactslist/{list_id}/contacts/store', 'ContactsController@store')->name('savecontact');

Route::get('/test', 'TestController@index');