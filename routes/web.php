<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EntrepriseController;

/*
|--------------------------------------------------------------------------
| Web Routes AfroBiz
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/create-entreprise', [EntrepriseController::class, 'store'])->name('entreprise.store');
Route::get('/create-entreprise', [EntrepriseController::class, 'create'])->middleware('auth')->name('entreprise.entreprise');
Route::get('/', [EntrepriseController::class, 'index'])->name('index');

Route::get('/entreprise/{id}', [EntrepriseController::class, 'show'])->name('entreprise.show');
Route::post('/avis', [AvisController::class, 'store'])->middleware('auth')->name('avis');

Route::match(['get', 'post'],'/recherche', [EntrepriseController::class, 'rechercher'])->name('resultats-recherche');
Route::post('/check-email-entreprise', [EntrepriseController::class, 'checkEmail'])->name('check.email.entreprise');
Route::post('/check-telephone-entreprise', [EntrepriseController::class, 'checkTelephone'])->name('check.telephone.entreprise');

require __DIR__.'/auth.php';
