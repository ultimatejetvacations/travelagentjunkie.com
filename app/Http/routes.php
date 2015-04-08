<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('/quote/approve-option/{quoteOptionId}', ['as' => 'quote.approveOption', 'uses' => 'QuoteController@approveOption']);
Route::post('quote/create-customer-profile', ['as' => 'quote.createCustomerProfile', 'uses' => 'QuoteController@createCustomerProfile']);
Route::post('quote/create-post-sale', ['as' => 'quote.createPostSale', 'uses' => 'QuoteController@createPostSale']);
Route::post('quote/save-traveler', ['as' => 'quote.saveTraveler', 'uses' => 'QuoteController@saveTraveler']);
Route::post('quote/save-credit-card', ['as' => 'quote.saveCreditCard', 'uses' => 'QuoteController@saveCreditCard']);
Route::get('quote/second-step/{token}', ['as' => 'quote.secondStep', 'uses' => 'QuoteController@secondStep']);
Route::get('quote/{token}', ['as' => 'quote', 'uses' => 'QuoteController@quote']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
