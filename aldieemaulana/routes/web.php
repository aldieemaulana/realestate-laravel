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

Route::get('/home', function () {
    if(Role::whereId(Session::get('role'))->value('name') == "manager"){
        return redirect('manager/dashboard');
    }else if(Role::whereId(Session::get('role'))->value('name') == "supervisor"){
        return redirect('supervisor/dashboard');
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
    Route::patch('transaction/fee/{id}', 'Manager\TransactionController@updateFee')->name('manager.transaction.fee');
    Route::get('transaction/location/{id}', 'Manager\TransactionController@getBlock')->name('manager.transaction.location');
});


Route::group(['prefix' => 'supervisor'], function () {
    Route::resource('user', 'Supervisor\UserController');
    Route::get('dashboard', 'Supervisor\DashboardController@dashboard')->name('supervisor.dashboard');
    Route::get('dashboard/{id}', 'Supervisor\DashboardController@filter')->name('supervisor.dashboard.filter');
    Route::get('dashboard/{id}/{title}', 'Supervisor\DashboardController@create')->name('supervisor.create');
    Route::post('dashboard/{id}/{title}', 'Supervisor\DashboardController@store')->name('supervisor.store');
    Route::get('dashboard/{id}/{title}/edit', 'Supervisor\DashboardController@edit')->name('supervisor.edit');
    Route::patch('dashboard/{id}/{title}/edit', 'Supervisor\DashboardController@update')->name('supervisor.update');
    Route::get('dashboard/{id}/{title}/show', 'Supervisor\DashboardController@show')->name('supervisor.show');
    Route::delete('dashboard/{id}', 'Supervisor\DashboardController@destroy')->name('supervisor.destroy');
    Route::get('setting', 'Supervisor\SupervisorController@setting')->name('supervisor.setting.edit');
    Route::patch('setting', 'Supervisor\SupervisorController@settingUpdate')->name('supervisor.setting.update');
});