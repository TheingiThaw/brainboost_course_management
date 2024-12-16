<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

Route::get('/', function () {
    return view('authentication.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/instructor.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';

//social Login

Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('social#redirect');

Route::get('/auth/{provider}/callback',[SocialLoginController::class,'callback'])->name('social#callback');
