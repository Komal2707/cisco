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


Route::group(['as' => 'cisco::', 'prefix' => 'cisco', 'namespace' => ''], function () {

    // Route::group(['as' => 'lists::', 'prefix' => 'lists', 'namespace' => 'Router'], function () {
    //     Route::get('router', ['middleware' => ['permission:' . ''], 'as' => 'router', 'uses' => 'CiscoRouterController@dataTable']);
    // });

    Route::group(['as' => 'router::', 'prefix' => 'router', 'namespace' => 'Router'], function () {

        Route::get('/', [ 'as' => 'list', 'uses' => 'CiscoRouterController@dataTable']);

        Route::get('create', [ 'as' => 'create', 'uses' => 'CiscoRouterController@create']);
        Route::get('edit/{router}', [ 'as' => 'edit', 'uses' => 'CiscoRouterController@edit']);
        Route::get('delete/{router}', [ 'as' => 'delete', 'uses' => 'CiscoRouterController@delete']);
        
        Route::post('store', ['middleware' => ['permission:' . ''], 'as' => 'store', 'uses' => 'CiscoRouterController@store']);
    });

});