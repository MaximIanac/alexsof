<?php

use App\Http\Controllers\ResponsesController;
use Illuminate\Support\Facades\Route;

Route::post('/responses', [ResponsesController::class, 'store'])->name('responses');
Route::get('/responses', [ResponsesController::class, 'index'])->name('get.responses');
Route::delete('/responses/{id}', [ResponsesController::class, 'destroy']);
