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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();
Auth::routes(['register'=>false]);
Route::redirect('register', 'login');
Route::redirect('home', 'dashboard');
Route::resource('users', 'UsersController');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/', 'HomeController@index');


Route::resource('listeners', 'ListenersController');
Route::get('/listeners/{id}/history', 'ListenersController@getHistory')->name('listenerHistory');

Route::resource('competitions', 'CompetitionsController');
Route::get('/competitions/{id}/addListener', 'CompetitionsController@searchOrCreateListeners')->name('searchListeners');

Route::get('/searchListener', 'LiveSearchController@searchListener')->name('searchListener');

Route::resource('/competitions/{competition_id}/prizes', 'PrizesController');
Route::get('/competitions/{id}/history', 'CompetitionsController@getHistory')->name('competitionHistory');
Route::get('find', 'LiveSearchController@find')->name('find');

Route::get('export', 'ListenersController@export')->name('export');
Route::post('import', 'ListenersController@import')->name('import');

Route::post('competitions/{competition_id}/addListener', 'CompetitionsController@addListenersToCompetition')->name('addListenersToCompetition');

Route::get('competitions/{competition_id}/draw', 'CompetitionsController@draw')->name('draw');
Route::get('export/winners/{competition_id}', 'CompetitionsController@export')->name('exportWinners');
Route::delete('competitions/{competition_id}/participants/{listener_id}/remove', 'CompetitionsController@removeParticipant')->name('removeParticipant');
Route::get('competitions/{competition_id}/participants/{listener_id}/edit', 'CompetitionsController@editParticipant')->name('editParticipant');
Route::put('competitions/{competition_id}/participants/{listener_id}/update', 'CompetitionsController@updateParticipant')->name('updateParticipant');