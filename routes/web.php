<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/EMlogin', [EmployeeController::class, 'showLoginForm'])->name('EMlogin');
Route::post('/EMlogin', [EmployeeController::class, 'login']);
Route::get('/EMdashboard', [EmployeeController::class, 'dashboard'])->middleware('emp.auth')->name('EMdashboard');
Route::post('/EMlogout', [EmployeeController::class, 'logout'])->name('EMlogout');

require __DIR__.'/auth.php';

