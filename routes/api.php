<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function () {
    Route::get('/monuments/translations', 'MonumentTranslationController@index');
    Route::post('/monuments/translations', 'MonumentTranslationController@store');
    Route::get('/monuments/translations/{id}', 'MonumentTranslationController@show');
    Route::delete('/monuments/translations/{id}', 'MonumentTranslationController@destroy');

    Route::resource('/users', 'UserController')->only([
        'index', 'store', 'destroy'
    ]);

    Route::resource('/languages', 'LanguageController')->only([
        'index', 'store', 'destroy'
    ]);

    Route::resource('/monuments', 'MonumentController')->only([
        'index', 'store', 'show', 'destroy'
    ]);
});

