<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\placeController;
use App\Http\Controllers\reservationController;





Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return redirect('/mon-espace');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/reservationprise' , [reservationController::class , 'reservationpriseGet'])->middleware(['auth']);

Route::post('/reservationprise' , [reservationController::class , 'reservationprisePost'])->middleware(['auth']);

Route::resource('/places' , placeController::class)->middleware(['auth']);

Route::resource('/admin' , adminController::class)->middleware(['auth']);

Route::resource('/reservation' , reservationController::class)->middleware(['auth']);

Route::get('/mon-espace' ,[ProfileController::class, 'espace'])->middleware(['auth']);

Route::get("/listeattente/{id}" , [adminController::class , 'getModifListeAttente'])->middleware(['auth']);

Route::get("/listeattente/{id}" , [adminController::class , 'getModifListeAttente'])->middleware(['auth']);

Route::get('/choixresa/{id}' , [reservationController::class , 'choixresa'])->middleware(['auth']);

Route::post('/choixresa/{id}' , [reservationController::class , 'choixresaPost'])->middleware(['auth']);



