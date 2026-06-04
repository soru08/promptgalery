<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;

// ========================================
// PUBLIC ROUTES — Gallery
// ========================================
Route::get('/', [PromptController::class, 'index'])->name('home');
Route::post('/prompts/{prompt}/copy', [PromptController::class, 'incrementCopy'])->name('prompts.copy');

Route::get('/debug-env', function() {
    return [
        'app_key_env' => env('APP_KEY') ? 'set' : 'not set',
        'app_key_getenv' => getenv('APP_KEY') ? 'set' : 'not set',
        'config_key' => config('app.key') ? 'set' : 'not set',
        'all_env_keys' => array_keys($_ENV),
        'all_server_keys' => array_keys($_SERVER),
    ];
});

