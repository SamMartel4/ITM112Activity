<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherSubjectController;

Route::get('/', function () {
    return redirect()->route('students.index');
});

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
