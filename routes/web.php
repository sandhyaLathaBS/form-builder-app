<?php

use App\Http\Middleware\is__admin;
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

Route::get('/',  [App\Http\Controllers\HomeController::class, 'forms'])->name('forms');
Route::get('/forms',  [App\Http\Controllers\HomeController::class, 'forms'])->name('forms');
Route::get('/fill-details/{id}',  [App\Http\Controllers\HomeController::class, 'showForm']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\FormBuilderController::class, 'dashboard'])->name('home');
    Route::get('/create-new-form', [App\Http\Controllers\FormBuilderController::class, 'index'])->name('create-new-form');
    Route::post('/save-new-form', [App\Http\Controllers\FormBuilderController::class, 'save'])->name('create.save');
    Route::post('/render-question', [App\Http\Controllers\FormBuilderController::class, 'renderQuestion'])->name('render.question');
});