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

use App\Role;

Route::get('', 'Home\HomeController@dashboard')->name('home.dashboard');
Route::get('/dashboard/{id}', 'Home\HomeController@filter')->name('home.filter');

Route::get('home', function () {
    if(Role::whereId(Session::get('role'))->value('name') == "manager"){
        return redirect('manager/dashboard');
    }else{
        return redirect('logout');
    }
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login.store');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.login.destroy');

Route::group(['prefix' => 'manager'], function () {
    Route::resource('user', 'Manager\UserController');
    Route::get('dashboard', 'Manager\DashboardController@dashboard')->name('manager.dashboard');
    Route::get('dashboard/{id}', 'Manager\DashboardController@filter')->name('manager.dashboard.filter');
    Route::get('dashboard/{id}/{title}', 'Manager\DashboardController@create')->name('manager.create');
    Route::post('dashboard/{id}/{title}', 'Manager\DashboardController@store')->name('manager.store');
    Route::get('dashboard/{id}/{title}/edit', 'Manager\DashboardController@edit')->name('manager.edit');
    Route::patch('dashboard/{id}/{title}/edit', 'Manager\DashboardController@update')->name('manager.update');
    Route::get('dashboard/{id}/{title}/show', 'Manager\DashboardController@show')->name('manager.show');
    Route::delete('dashboard/{id}', 'Manager\DashboardController@destroy')->name('manager.destroy');
    Route::get('setting', 'Manager\ManagerController@setting')->name('manager.setting.edit');
    Route::patch('setting', 'Manager\ManagerController@settingUpdate')->name('manager.setting.update');
    Route::resource('location', 'Manager\LocationController');
    Route::resource('block', 'Manager\BlockController');
    Route::resource('transaction', 'Manager\TransactionController');
});