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




Route::namespace('Front')->group(function() {
    // Profile
    Route::prefix('profile')->middleware('player')->group(function() {
        Route::name('profile')->get('/', 'UserController@profile');
        Route::name('profile.settings')->get('/settings', 'UserController@settings');
        Route::name('profile.update')->put('/settings', 'UserController@update');
    });

    // Tournaments
    Route::prefix('tournaments')->group(function() {
        Route::name('tournaments')->get('/', 'TournamentController@index');
        Route::name('tournaments.display')->get('{slug}', 'TournamentController@show');
        Route::name('tournaments.display.rules')->get('{slug}/rules', 'TournamentController@rules');
        Route::name('tournaments.display.classes')->get('{slug}/classes','TournamentController@classes');
        Route::name('tournaments.display.participants')->get('{slug}/participants','TournamentController@participants');
        Route::name('tournaments.display.grid')->get('{slug}/grid','TournamentController@grid');

        Route::name('tournaments.participants.store')->get('{tournament}/participants/store','ParticipantController@store');
        Route::name('tournaments.participants.confirm')->get('{tournament}/participants/confirm','ParticipantController@confirm');
        Route::name('tournaments.participants.cancel')->get('{tournament}/participants/cancel','ParticipantController@cancel');
        Route::name('tournaments.participants.add-hero-class')->post('participants/add-hero-class/{participant}/{cid}', 'ParticipantController@toggleHeroClass');

    });
});

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

        // Tournaments
        Route::name('tournaments.active')->put('tournaments/active/{tournament}/{status?}', 'TournamentController@updateActive');
    });
    
    Route::middleware('admin')->group(function() {
        // Users
        Route::name('users.seen')->put('users/seen/{user}', 'UserController@updateSeen');
        Route::resource('users', 'UserController', ['only' => [
            'index', 'edit', 'update', 'destroy'
        ]]);

        // Tournaments
        Route::name('tournaments.seen')->put('tournaments/seen/{tournament}', 'TournamentController@updateSeen');
        Route::resource('tournaments', 'TournamentController');
    });
    
});
