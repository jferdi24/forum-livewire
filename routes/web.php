<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Livewire\ShowThread;
use App\Http\Livewire\ShowThreads;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', ShowThreads::class)
        ->name('dashboard');

    Route::get('/thread/{thread}', ShowThread::class)
        ->name('thread');

    Route::resource('threads', ThreadController::class)
        ->except([
            'show',
            'index',
            'destroy',
        ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
