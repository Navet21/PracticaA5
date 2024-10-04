<?php

use App\Http\Controllers\CommunityLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CommunityLinkController::class,'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::post('/dashboard', [CommunityLinkController::class,'store'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::get('/analytics', function () {
    return view('analytics');
})->middleware(['auth', 'verified'])->name('analytics');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
