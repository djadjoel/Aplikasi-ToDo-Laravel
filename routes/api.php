<?php 
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthapiController;

// Route::middleware('auth.token')->group(function () {
//     Route::get('/api/beranda', [TodoController::class, 'index']);
//     Route::post('/beranda', [TodoController::class, 'store']);
//     Route::put('/beranda/{id}', [TodoController::class, 'update']);
//     Route::delete('/beranda/{id}', [TodoController::class, 'destroy']);
// });