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

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/purchase', 'HomeController@purchase')->name('purchase');
    Route::get('/transactions', 'HomeController@transacHistory')->name('transacHistory');
    
    Route::get('/mailbox', 'MailBoxController@index')->name('mailbox');
    Route::get('/inbox/{mailboxId}', 'MailBoxController@inbox')->name('inbox');
    Route::get('/sentbox/{mailboxId}', 'MailBoxController@sentBox')->name('sentBox');
    Route::get('/email/{id}', 'MailBoxController@emailById')->name('emailById');
    Route::match(['get', 'post'],'/send-email/{mailboxId}', 'MailBoxController@sendEmail')->name('sendEmail');
});
