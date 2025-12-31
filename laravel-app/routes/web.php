<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // Logic to authenticate user
    return redirect('/dashboard');
});

Route::get('/logout', function () {
    // Logic to logout
    return redirect('/login');
});

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/accounts', function () {
        return view('admin.accounts');
    })->name('admin.accounts');

    Route::get('/packages', function () {
        return view('admin.packages'); // To be implemented
    })->name('admin.packages');

    Route::get('/schedules', function () {
        return view('admin.schedules'); // To be implemented
    })->name('admin.schedules');

    Route::get('/attendance', function () {
        return view('admin.attendance'); // To be implemented
    })->name('admin.attendance');
});

// Student Routes
Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    Route::get('/packages', function () {
        return view('student.packages'); // To be implemented
    })->name('student.packages');

    Route::get('/schedule', function () {
        return view('student.schedule'); // To be implemented
    })->name('student.schedule');

    Route::get('/history', function () {
        return view('student.history'); // To be implemented
    })->name('student.history');
});

// Teacher Routes
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');

    Route::get('/schedule', function () {
        return view('teacher.schedule'); // To be implemented
    })->name('teacher.schedule');

    Route::get('/attendance', function () {
        return view('teacher.attendance'); // To be implemented
    })->name('teacher.attendance');
});
