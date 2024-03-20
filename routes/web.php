<?php

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
Route::get('/pages/contact', function () {
    return view('pages/contact');
});

Route::group(['middleware' => 'admin'], function () {
Route::get('/pages/actualite', [App\Http\Controllers\ArticleController::class, 'index'])->name('pages.actualite');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\RepportingController::class, 'admin'])->name('admin');
Route::post('/admin/create', [App\Http\Controllers\RepportingController::class, 'admin_store'])->name('create_admin');



Route::get('/utilisateur', [App\Http\Controllers\RepportingController::class, 'utilisateur'])->name('utilisateur');
Route::post('/utilisateur/create', [App\Http\Controllers\RepportingController::class, 'utilisateur_store'])->name('utilisateur_admin');

Route::get('/autre', [App\Http\Controllers\RepportingController::class, 'autre'])->name('autre');
Route::post('/autre/create', [App\Http\Controllers\RepportingController::class, 'autre_store'])->name('autre_admin');
Route::get('/resultat', [App\Http\Controllers\RepportingController::class, 'resultat'])->name('resultat');

Route::get('/formation', [App\Http\Controllers\RepportingController::class, 'formation'])->name('formation');

Route::post('/formation/create', [App\Http\Controllers\RepportingController::class, 'formation_store'])->name('formation_admin');
Route::get('/reservation', [App\Http\Controllers\RepportingController::class, 'reservation'])->name('reservation');

});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/pages/actualite', [App\Http\Controllers\ArticleController::class, 'index'])->name('pages.actualite');
    Route::get('/activites/jeux/{id}', [App\Http\Controllers\AutreController::class, 'show'])->name('activites.jeux');
    Route::get('/reserver/{id}', [App\Http\Controllers\AutreController::class, 'reserver'])->name('reserver');
    Route::post('/reserver', [App\Http\Controllers\AutreController::class, 'reserver_store'])->name('reserver.formation');
    

    });
Auth::routes();
