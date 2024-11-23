<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/guest-dashboard', function () {
    return view('guest-dashboard');
})->name('guest.dashboard');

Route::get('/contact', function () {
    return view('contact');
})->middleware(['auth', 'verified'])->name('contact');


Route::post('/contact', [ContactController::class, 'sendMail'])->middleware(['auth', 'verified'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile.picture.update');
    Route::put('/profile', [ProfileController::class, 'updateAboutMe'])->name('about.update');
});
Route::get('/dashboard-search', [DashboardController::class, 'searchUsers'])->name('search.users');

require __DIR__.'/auth.php';

