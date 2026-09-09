<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;

// ========================================
// PUBLIC ROUTES — Gallery
// ========================================
Route::get('/', [PromptController::class, 'index'])->name('home');
Route::post('/prompts/{prompt}/copy', [PromptController::class, 'incrementCopy'])->name('prompts.copy');

if (app()->environment('local')) {
    Route::get('/debug-config', function() {
        $env_lines = file_exists(base_path('.env')) ? file(base_path('.env')) : [];
        $env_info = [];
        foreach ($env_lines as $line) {
            $line = trim($line);
            if (!$line || str_contains($line, '=')) {
                $parts = explode('=', $line, 2);
                if (count($parts) === 2) {
                    $key = $parts[0];
                    $val = $parts[1];
                    $env_info[$key] = [
                        'length' => strlen($val),
                        'is_empty' => empty($val),
                    ];
                }
            }
        }

        $config_path = base_path('bootstrap/cache/config.php');
        $config_info = [];
        if (file_exists($config_path)) {
            $config = require $config_path;
            $db = $config['database']['connections']['mysql'] ?? [];
            $config_info = [
                'host_len' => isset($db['host']) ? strlen($db['host']) : 0,
                'database_len' => isset($db['database']) ? strlen($db['database']) : 0,
                'username_len' => isset($db['username']) ? strlen($db['username']) : 0,
                'password_len' => isset($db['password']) ? strlen($db['password']) : 0,
            ];
        }

        return [
            'env_file_variables' => $env_info,
            'cached_config_db_lengths' => $config_info,
        ];
    });
}

