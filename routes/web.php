<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;

// ========================================
// PUBLIC ROUTES — Gallery
// ========================================
Route::get('/', [PromptController::class, 'index'])->name('home');
Route::post('/prompts/{prompt}/copy', [PromptController::class, 'incrementCopy'])->name('prompts.copy');
