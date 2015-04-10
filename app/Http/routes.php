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

Route::group(['https', 'prefix' => 'quote'], function()
{
    Route::post('approve-option/{quoteOptionId}', ['as' => 'quote.approveOption', 'https', 'uses' => 'QuoteController@approveOption']);
    Route::post('create-customer-profile', ['as' => 'quote.createCustomerProfile', 'uses' => 'QuoteController@createCustomerProfile']);
    Route::post('create-post-sale', ['as' => 'quote.createPostSale', 'uses' => 'QuoteController@createPostSale']);
    Route::post('save-traveler', ['as' => 'quote.saveTraveler', 'uses' => 'QuoteController@saveTraveler']);
    Route::post('save-credit-card', ['as' => 'quote.saveCreditCard', 'uses' => 'QuoteController@saveCreditCard']);
    Route::get('second-step/{token}', ['as' => 'quote.secondStep', 'uses' => 'QuoteController@secondStep']);
    Route::get('{token}', ['as' => 'quote', 'https', 'uses' => 'QuoteController@quote']);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
