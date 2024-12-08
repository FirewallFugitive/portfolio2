<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\FaqController2;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MessageController;


Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/users/{user}/promote', [AdminController::class, 'promote'])->name('users.promote');
    Route::post('/users/{user}/demote', [AdminController::class, 'demote'])->name('users.demote');
    Route::get('/users/create', [AdminController::class, 'showCreateForm'])->name('users.create');
    Route::post('/users/create', [AdminController::class, 'createUser'])->name('users.store');
    Route::get('/news/admin', [NewsController::class, 'adminIndex'])->name('news.admin');

});
Route::aliasMiddleware('admin', AdminMiddleware::class);

Route::post('/contact', [ContactController::class, 'sendMail'])->name('contact');


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
    return view('contact'); // Zorg ervoor dat 'contact' verwijst naar de juiste Blade-template.
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile.picture.update');
    Route::put('/profile', [ProfileController::class, 'updateAboutMe'])->name('about.update');
    Route::get('/inbox/{id}', [MessageController::class, 'inbox'])->name('inbox');
});

Route::get('/dashboard-search', [DashboardController::class, 'searchUsers'])->name('search.users');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::delete('/admin/faqs/{faq}', [FaqController2::class, 'destroy'])->name('admin.faqs.destroy');
Route::delete('/admin/categories/{category}', [FaqController2::class, 'destroyCategory'])->name('admin.categories.destroy');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController2::class)->names('admin.faqs');
});

Route::resource('news', NewsController::class);

Route::post('/messages/reply', [MessageController::class, 'reply'])->name('messages.reply');
Route::get('/message/compose/{receiver_id}', [MessageController::class, 'compose'])->name('message.compose');
Route::post('/message', [MessageController::class, 'send'])->name('message.send');

require __DIR__.'/auth.php';

