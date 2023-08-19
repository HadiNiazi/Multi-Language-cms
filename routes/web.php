<?php

use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::prefix('admin')->as('admin.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::prefix('translations')->as('translations.')->group(function() {
            Route::get('/', [TranslationController::class, 'openTranslationPage'])->name('index');
        });
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});
