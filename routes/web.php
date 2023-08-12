<?php

use App\Http\Controllers\Auth\DashboardController;
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
    return view('auth.general');
});

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::prefix('auth')->as('auth.')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});
