<?php

use App\Http\Controllers\Admin\ClinicianController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FruitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Translator\DashboardController as TranslatorDashboardController;
use App\Http\Controllers\Translator\SectionController;
use App\Http\Controllers\Translator\FruitController as TranslatorFruitController;
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

Auth::routes([
    'register' => false,
    'verify' => true
]);

Route::middleware('auth')->group(function() {

    Route::get('profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update/{id}', [DashboardController::class, 'updateProfile'])->name('profile.update');

    Route::prefix('admin')->as('admin.')->middleware(['is_admin'])->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::get('languages', [UserController::class, 'loadLanguages'])->name('languages');
        Route::resource('users', UserController::class);
        Route::resource('fruits', FruitController::class);

    });


    // Route::prefix('translator')->as('translator.')->middleware('verified')->group(function() {


        // prefix('sections')->as('sections.')->
        Route::middleware('verified')->group(function() {
            Route::get('/dashboard', [TranslatorDashboardController::class, 'dashboard'])->name('dashboard');
            Route::get('/sections', [SectionController::class, 'openSectionsPage'])->name('sections.index');
            Route::get('/languages', [TranslatorFruitController::class, 'openLanguagesPage'])->name('languages');
            Route::get('fruits/language/{language?}', [TranslatorFruitController::class, 'openFruitsPage'])->name('fruits.index');
            Route::get('fruits/translations/{fruit}/edit', [TranslatorFruitController::class, 'editFruitTranslationPage'])->name('fruits.translations.edit');
            Route::post('fruits/translations/store', [TranslatorFruitController::class, 'storeFruitTranslations'])->name('fruits.translations.store');
        });
    // });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::as('site.')->controller(HomeController::class)->group(function() {
    Route::get('/', 'openHomePage')->name('home');
    Route::get('/{language}/fruits/{fruit_id}', 'openFruitDetailsPage')->name('fruits.details');

    Route::get('/{langauge}', 'openLanguagesPage')->name('languages');

    Route::get('/{language}/{item}', 'openItemsPage')->name('language.item');

    // Route::get('/frutis', 'openFruitsPage')->name('fruits.index');
});
