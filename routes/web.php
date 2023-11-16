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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/professeur', [App\Http\Controllers\RepportingController::class, 'professeur'])->name('professeur');
Route::post('/professeur/create', [App\Http\Controllers\RepportingController::class, 'professeur_store'])->name('create_professor');



Route::get('/etudiant', [App\Http\Controllers\RepportingController::class, 'etudiant'])->name('etudiant');
Route::post('/etudiant/create', [App\Http\Controllers\RepportingController::class, 'etudiant_store'])->name('etudiant_professor');


Auth::routes();
