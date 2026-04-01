<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Authentication routes
require __DIR__.'/auth.php';

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes (needed by the user menu and profile update flows)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student routes
    Route::resource('students', StudentController::class);

    // Query routes
    Route::get('/queries', [QueryController::class, 'index'])->name('queries.index');
    Route::get('/queries/search/skill', [QueryController::class, 'searchBySkill'])->name('queries.skill');
    Route::get('/queries/search/activity', [QueryController::class, 'searchByActivity'])->name('queries.activity');
    Route::get('/queries/search/advanced', [QueryController::class, 'advancedSearch'])->name('queries.advanced');
    Route::get('/api/skills', [QueryController::class, 'getSkills'])->name('api.skills');
    Route::get('/api/activities', [QueryController::class, 'getActivities'])->name('api.activities');
});
