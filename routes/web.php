<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['namespace' => '\App\Http\Controllers', 'middleware' => 'auth'], function () {
    Route::get('/', "\App\Http\Controllers\DashboardController@index");
    Route::resource("members", "MembersController");
    Route::resource('teams', 'TeamsController');

    Route::get('seasons/{season}/fixtures/generate', 'FixturesController@generate')->name('fixtures.generate');
    Route::post('seasons/{season}/fixtures/generate', 'FixturesController@doGenerate')->name('fixtures.doGenerate');
    Route::resource('seasons/{season}/fixtures', 'FixturesController');

    Route::resource('seasons', 'SeasonsController');
    Route::resource('locations', 'LocationsController');
});
