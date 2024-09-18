<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\ListingsController;


Route::get('/', [RealEstateController::class, 'index'])->name('home');
route::post('/', [AgentController::class, 'store'])->name('agent.store');

Route::post('/real-estates', [ListingsController::class, 'store'])->name('real-estates.store');
Route::get('add_listings', [ListingsController::class, 'index'])->name('add_listings');

Route::get('/real-estates/{id}', [RealEstateController::class, 'show'])->name('real-estates.show');
Route::delete('/real-estates/{id}', [RealEstateController::class, 'destroy'])->name('real-estates.destroy');



