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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/create-new-form', [App\Http\Controllers\FormBuilderController::class, 'index'])->name('create-new-form');
    Route::post('/save-new-form', [App\Http\Controllers\FormBuilderController::class, 'save'])->name('create.save');
    Route::post('/render-question', [App\Http\Controllers\FormBuilderController::class, 'renderQuestion'])->name('render.question');
});