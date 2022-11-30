<?php

use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->name('users.')->prefix('users')->controller(UserController::class)->group(function(){
    Route::get('/' ,'index')->name('index');

    Route::get('/create' ,'create')->name('create');

    Route::post('/store','store')->name('store');

    Route::get('/{id}/edit' ,'edit')->name('edit');

    Route::put('/{id}/update' ,'update')->name('update');
});



