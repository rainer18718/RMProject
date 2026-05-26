<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[UserController::class, 'login']);
Route::post('/',[UserController::class, 'login']);
Route::get('/maintenance', [PagesController::class, 'maintenance']);

Route::middleware('auth.session')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/student/dashboard', [DashboardController::class, 'student'])
        ->middleware('role:student')
        ->name('student.dashboard');

    Route::get('/teacher/dashboard', [DashboardController::class, 'teacher'])
        ->middleware('role:teacher')
        ->name('teacher.dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::get('/students/ajax/list', [StudentController::class, 'ajaxIndex'])->name('students.ajax.index');
        Route::resource('degrees', DegreeController::class);
        Route::resource('students', StudentController::class)->middleware('maintenance');
        Route::resource('teachers', TeacherController::class)->only(['index', 'create', 'store']);
    });
});

Route::middleware('groupMiddleware')->group(function () {
    Route::get('/user_profile', [PagesController::class, 'userProfile'])->name('user_profile');
    Route::get('/user_posts', [PagesController::class, 'userPosts'])->name('user_posts');
    Route::get('/student_courses', [PagesController::class, 'studentCourses'])->name('student_courses');
});
