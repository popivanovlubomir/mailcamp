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
Route::get('/campaigns/sendemail', 'CampaignsController@sendMassMailPage')->name('sendemailview');
Route::post('/campaigns/sendemail', 'CampaignsController@sendAutomaticallMassMail')->name('sendmassemail');
Route::post('/campaigns/store', 'CampaignsController@store')->name('savecampaign');
Route::post('/campaigns/{id}/sendtest', 'CampaignsController@testCampaign')->name('testcampaign');
Route::post('/campaigns/sendcampaign', 'CampaignsController@sendCampaign')->name('sendcampaign');

/* Contacts lists routes */
Route::get('/contactslist', 'ContactsListsController@index')->name('contactslist');
Route::get('/contactslist/create', 'ContactsListsController@create')->name('createcontactslist');
Route::post('/contactslist/store', 'ContactsListsController@store')->name('savecontactslist');
Route::post('/contactslist/remove', 'ContactsListsController@destroy')->name('removecontactslistc');

/* Contacts routes*/
Route::get('/contactslist/{list_id}/contacts', 'ContactsController@index')->name('viewcontacts');
Route::get('/contactslist/{list_id}/contacts/create', 'ContactsController@create')->name('createcontact');
Route::post('/contactslist/{list_id}/contacts/store', 'ContactsController@store')->name('savecontact');
Route::post('/contactslist/{list_id}/contacts/import', 'ContactsController@importCSV')->name('importcontacts');

/* Senders routes */
Route::get('/senders', 'SendersController@index')->name('listsenders');
Route::get('/senders/view/{id}', 'SendersController@show')->name('viewsender');
Route::get('/senders/create', 'SendersController@create')->name('createsender');
Route::post('/senders/store', 'SendersController@store')->name('savesender');

/* Suppression groups routes */
Route::get('/suppressiongroups', 'SuppressionGroupsController@index')->name('listsuppressiongroups');
Route::get('/suppressiongroups/view/{id}', 'SuppressionGroupsController@show')->name('viewsuppressiongroup');
Route::get('/suppressiongroups/create', 'SuppressionGroupsController@create')->name('createsuppressiongroup');
Route::post('/suppressiongroups/store', 'SuppressionGroupsController@store')->name('savesuppressiongroup');


Route::get('/test', 'TestController@index');