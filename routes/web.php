<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;

// ========================================
// PUBLIC ROUTES — Gallery
// ========================================
Route::get('/', [PromptController::class, 'index'])->name('home');
Route::post('/prompts/{prompt}/copy', [PromptController::class, 'incrementCopy'])->name('prompts.copy');

Route::get('/debug-config', function() {
    $env = file_exists(base_path('.env')) ? file_get_contents(base_path('.env')) : 'no .env';
    $env = preg_replace('/(APP_KEY|DB_PASSWORD|DB_DATABASE|DB_USERNAME)=.*/', '$1=******', $env);

    $config_path = base_path('bootstrap/cache/config.php');
    $config_data = 'no config cache';
    if (file_exists($config_path)) {
        $config = require $config_path;
        if (isset($config['app']['key'])) $config['app']['key'] = '******';
        if (isset($config['database']['connections']['mysql']['password'])) $config['database']['connections']['mysql']['password'] = '******';
        if (isset($config['database']['connections']['mysql']['database'])) $config['database']['connections']['mysql']['database'] = '******';
        if (isset($config['database']['connections']['mysql']['username'])) $config['database']['connections']['mysql']['username'] = '******';
        $config_data = json_encode($config);
    }

    return [
        'env_file' => $env,
        'cached_config' => json_decode($config_data, true),
    ];
});

