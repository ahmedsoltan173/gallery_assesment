<?php

use App\Http\Controllers\albumController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('albums/', App\Http\Controllers\albumController::class);

/**
 * ========================================
 * ==========Routes of album===============
 * ========================================
 */

Route::get('/', [App\Http\Controllers\albumController::class, 'index'])->name('album');
Route::get('/Album', [App\Http\Controllers\albumController::class, 'index'])->name('album');
Route::get('/Album/create', [App\Http\Controllers\albumController::class, 'create'])->name('album.create');
Route::post('/Album/store', [App\Http\Controllers\albumController::class, 'store'])->name('album.store');
Route::get('/Album/edit/{id}', [App\Http\Controllers\albumController::class, 'edit'])->name('album.edit');
Route::post('/Album/update/{id}', [App\Http\Controllers\albumController::class, 'update'])->name('album.update');
Route::get('/Album/show/{id}', [App\Http\Controllers\albumController::class, 'show'])->name('album.show');
Route::get('/Album/delete/{id}', [App\Http\Controllers\albumController::class, 'destroy'])->name('album.destroy');
Route::get('/Album/destroyAll/{id}', [App\Http\Controllers\albumController::class, 'destroyAll'])->name('album.destroyAll');
/**
 * ========================================
 * ==========Routes of album===============
 * ========================================
 */
Route::get('/image', [App\Http\Controllers\ImageController::class, 'index'])->name('image');
Route::get('/image/create/{id}', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/store', [App\Http\Controllers\ImageController::class, 'store'])->name('image.store');
Route::get('/image/edit/{id}', [App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update/{id}', [App\Http\Controllers\ImageController::class, 'update'])->name('image.update');
Route::get('/image/show/{id}', [App\Http\Controllers\ImageController::class, 'show'])->name('image.show');
Route::get('/image/delete/{id}', [App\Http\Controllers\ImageController::class, 'destroy'])->name('image.destroy');
