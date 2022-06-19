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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/bruotes')->name('bruotes::')->group(function () {
    Route::get('', [\App\Http\Controllers\BruoteController::class, 'index'])->name('index');
    Route::post('store', [\App\Http\Controllers\BruoteController::class, 'store'])->middleware('auth')->name('store');
    Route::get('delete/{id}', [\App\Http\Controllers\BruoteController::class, 'delete'])->middleware('auth')->name('delete');
});

Route::prefix('breads')->name('breads::')->group(function() {
    Route::get('', [\App\Http\Controllers\BreadController::class, 'index'])->name('index');
    Route::get('photo/{bread}', [\App\Http\Controllers\BreadController::class, 'photo'])->name('photo');
    Route::middleware('auth')->group(function() {
        Route::get('add', [\App\Http\Controllers\BreadController::class, 'create'])->name('create');
        Route::get('edit/{bread}', [\App\Http\Controllers\BreadController::class, 'edit'])->name('edit');
        Route::post('store/{bread?}', [\App\Http\Controllers\BreadController::class, 'store'])->name('store');
        Route::get('delete/{bread}', [\App\Http\Controllers\BreadController::class, 'delete'])->name('delete');
    });
});
