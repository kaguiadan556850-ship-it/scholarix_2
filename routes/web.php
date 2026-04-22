<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

// Default redirect
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.dashboard');
    }
    return redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/scholarships', [StudentController::class, 'scholarships'])->name('scholarships');
    Route::get('/scholarships/{scholarship}', [StudentController::class, 'showScholarship'])->name('scholarship.show');
    Route::post('/scholarships/{scholarship}/apply', [StudentController::class, 'applyScholarship'])->name('scholarship.apply');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    Route::get('/students/{student}', [AdminController::class, 'showStudent'])->name('student.show');
    Route::get('/scholarships', [AdminController::class, 'scholarships'])->name('scholarships');
    Route::get('/scholarships/create', [AdminController::class, 'createScholarship'])->name('scholarship.create');
    Route::post('/scholarships', [AdminController::class, 'storeScholarship'])->name('scholarship.store');
    Route::get('/scholarships/{scholarship}/edit', [AdminController::class, 'editScholarship'])->name('scholarship.edit');
    Route::put('/scholarships/{scholarship}', [AdminController::class, 'updateScholarship'])->name('scholarship.update');
    Route::delete('/scholarships/{scholarship}', [AdminController::class, 'deleteScholarship'])->name('scholarship.delete');
    Route::get('/applications', [AdminController::class, 'applications'])->name('applications');
    Route::get('/applications/{application}', [AdminController::class, 'showApplication'])->name('application.show');
    Route::put('/applications/{application}', [AdminController::class, 'updateApplicationStatus'])->name('application.update');
});
