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

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/errors', 'AddError@index')->name('error');
Route::get('/quotation', 'QuotationController@index')->name('quotation');
Route::get('/calculator', 'CalculatorController@index')->name('calculator');

// Set calculator end points
//
//
Route::post('/get-price', 'CalculatorController@selectCalculation');

Route::post('/add-error', 'AddError@store');
Route::post('/update', 'AddError@updatePayment')->name('update');
Route::post('/remove-paid', 'AddError@removePayment')->name('remove-paid');

Route::get('/send', 'EmailController@HTMLEmail');
Route::get('mailable', function () {
    $errors = App\Error::where('paid', 0)->get();
    return new App\Mail\ErrorOverview($errors);
});
