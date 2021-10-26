<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
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
    return redirect('admin');
});

Auth::routes();


Route::prefix('/admin')->name('admin.')->group(function(){
    Route::namespace('App\Http\Controllers\Admin\Auth')->group(function(){

        //Login Routes
        Route::get('/','LoginController@showLoginForm');
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');

    });

    Route::group(['middleware' => 'isAdmin'], function() {
        Route::get('/dashboard','App\Http\Controllers\Admin\AdminController@index')->name('home');

        Route::resource('company', \App\Http\Controllers\Admin\CompanyController::class);
        Route::resource('employee', \App\Http\Controllers\Admin\EmployeeController::class);
    });
});
