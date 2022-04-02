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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/*
| Admin user management APIs routes.
*/
Route::group([
    'prefix' => 'admin/form',
    'middleware' => ['auth'],
    'namespace' => 'App\Http\Controllers',
    'controller' => 'AdminController',
], function () {
    Route::get('dashboard', 'formListTemplate')->name('formListTemplate');
    Route::get('create', 'formCreateTemplate')->name('formCreateTemplate');
    Route::get('read/{formId}', 'formEditTemplate')->name('formEditTemplate');

    Route::post('update/{formId}', 'formUpdate')->name('formUpdate');
    Route::post('create', 'formCreate')->name('formCreate');
    Route::delete('delete/{formId}', 'formDelete')->name('formDelete');
});

/*
| Public form.
*/
Route::group([
    'prefix' => 'public/form',
    'namespace' => 'App\Http\Controllers',
    'controller' => 'UserController',
], function () {
    Route::get('form', 'publicFormListTemplate')->name('publicFormListTemplate');
});
