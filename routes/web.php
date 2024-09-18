<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NationalVoteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DistrictVoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/national-vote', [NationalVoteController::class, 'create'])->name('nationalvote.create');
    Route::post('/nationalvote', [NationalVoteController::class, 'store'])->name('nationalvote.store');
   
    Route::get('/national-results', [NationalVoteController::class, 'showResults'])->name('nationalresults');
   
    

    Route::get('/district-vote', [DistrictVoteController::class, 'create'])->name('districtvote.create');
    Route::post('/districtvote',[DistrictVoteController::class,'store'])->name('districtvote.store');

    Route::get('/district-results', [DistrictVoteController::class, 'showResults'])->name('districtresults');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
require __DIR__.'/auth.php';
