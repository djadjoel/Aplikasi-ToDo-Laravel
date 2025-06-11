<?php
use App\Http\Controllers\Default\AuthController;
use App\Http\Controllers\Default\VerificationController;
use App\Http\Controllers\Default\PasswordResetController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Publik\BerandaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthapiController;
use App\Http\Controllers\Api\TodoController;

// Login backend
Route::prefix('default')->group(function () {
    // Login & Register
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('default.logout');

    // Email Verification
    Route::get('/email/verify', [VerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->middleware('auth')->name('verification.resend');

    // Password Reset
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('forgot-password');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('forgot-password.send');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset-password');
});
//admin
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    //Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggleStatus');
});
//publik
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/api/quote', [BerandaController::class, 'getQuote']);

//login frontend api
Route::view('/login', 'authapi.login')->name('login');
Route::post('/api/login', [AuthapiController::class, 'login']);
Route::post('/api/logout', [AuthapiController::class, 'logout'])->middleware('auth.token');


Route::middleware('auth.token')->group(function () {
    Route::get('/api/beranda', [TodoController::class, 'index']);
    Route::post('/api/beranda', [TodoController::class, 'store']);
    Route::put('/api/beranda/{id}', [TodoController::class, 'update']);
    Route::delete('/api/beranda/{id}', [TodoController::class, 'destroy']);
});
