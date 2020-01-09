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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('teams', 'TeamController');
Route::get('/teams/delete/{team}', 'TeamController@delete')->name('teams.delete');

Route::resource('teams/{team}/users', 'TeamUserController')->names([
	'index' => 'teams.users.index',
	'store' => 'teams.users.store',
	'destroy' => 'teams.users.destroy',
]);
Route::get('teams/{team}/users/{user}/delete', 'TeamUserController@delete')->name('teams.users.delete');


Route::resource('teams/{team}/subscriptions', 'TeamSubscriptionController')->names([
	'index' => 'teams.subscriptions.index',
	'store' => 'teams.subscriptions.store',
]);

Route::resource('teams/{team}/subscriptions/swap', 'TeamSubSwapRoleController')->names([
	'store' => 'teams.subscriptions.swap.store',
]);

Route::get('teams/{team}/users/{user}/roles', 'TeamUserRoleController@edit')
	->name('teams.users.roles.edit');

Route::patch('teams/{team}/users/{user}/roles/update', 'TeamUserRoleController@update')
	->name('teams.users.roles.update');
/*Route::resource('teams/{team}/users/{user}/roles', 'TeamUserRoleController')->names([
	'edit' => 'teams.users.roles.edit',
	
]); */

