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

// Home
Route::name('home')->get('/', 'Front\IndexController@index');

// Authentification
Auth::routes();

/*
 * Backend
 */
Route::prefix('admin')->namespace('Back')->group(function() {
    Route::middleware('author')->group(function() {
        Route::name('admin')->get('/', 'AdminController@index');
        
        // News
        Route::resource('news', 'NewsController');
    });
    
    Route::middleware('admin')->group(function() {
        Route::resource('users', 'UserController', ['only' => [
            'index', 'edit', 'update', 'destroy'
        ]]);
    });
    
});
