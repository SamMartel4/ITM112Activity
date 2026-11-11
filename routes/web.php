<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;

// Redirect users
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Login and Registration
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [RegistrationController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegistrationController::class, 'register'])
        ->name('register.submit');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Protected pages
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'auth.dashboard')
        ->name('dashboard');

    // Students
    Route::resource('students', StudentController::class);

    // Teachers
    Route::resource('teachers', TeacherController::class)
        ->only(['index', 'create', 'store']);

    // Assign Classes
    Route::get('/teachers/{teacher}/assign', [
        TeacherController::class,
        'assign'
    ])->name('teachers.assign');

    Route::put('/teachers/{teacher}/assign', [
        TeacherController::class,
        'updateAssignments'
    ])->name('teachers.assign.update');

    // Subjects
    Route::resource('subjects', SubjectController::class);

    // Assign Subjects
    Route::get('/teachers/{id}/subjects', [
        TeacherSubjectController::class,
        'edit'
    ])->name('teachers.subjects.edit');

    Route::put('/teachers/{id}/subjects', [
        TeacherSubjectController::class,
        'update'
    ])->name('teachers.subjects.update');
});
