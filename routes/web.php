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

Auth::routes([
    'register' => true,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::group([
    'namespace' => 'Web'
], function () {
    Route::get('/', 'PageController@index');

    Route::get('/feedback', 'ReviewController@showSendForm')->name('feedback');
    Route::post('/feedback', 'ReviewController@sendReview')->name('sendReview');

    Route::group([
        'middleware' => 'auth'
    ], function () {
        Route::get('/weather', 'PageController@weather')->name('weather');

        Route::get('/reviews', 'ReviewController@index')->name('reviews');
    });
});
