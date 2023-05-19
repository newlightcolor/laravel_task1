<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\DiaryController;

Route::get('/', [DiaryController::class, 'index']);
Route::get('/diary', [DiaryController::class, 'index']);
Route::get('/diary/detail/{id}', [DiaryController::class, 'detail']);
Route::get('/diary/edit', [DiaryController::class, 'edit']);
Route::post('/diary', [DiaryController::class, 'post']);
Route::post('/diary/update', [DiaryController::class, 'put']);
Route::delete('/diary/{id}', [DiaryController::class, 'delete']);
Route::get('/diary/create', [DiaryController::class, 'create']);
