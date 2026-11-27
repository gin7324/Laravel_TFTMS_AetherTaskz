<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view('/profile', 'pages.profile')->name('profile.public');
Route::view('/about', 'pages.about')->name('about');

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->except(['index', 'show']);

    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('account.profile.edit');
    Route::patch('/account/profile', [ProfileController::class, 'update'])->name('account.profile.update');
    Route::delete('/account/profile', [ProfileController::class, 'destroy'])->name('account.profile.destroy');

    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');
});

Route::resource('tasks', TaskController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
