<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Portrait',       'slug' => 'portrait',       'icon' => '👤', 'color' => '#8b5cf6', 'description' => 'Foto potret manusia, ekspresi wajah, dan close-up karakter'],
            ['name' => 'Landscape',      'slug' => 'landscape',      'icon' => '🌄', 'color' => '#06b6d4', 'description' => 'Pemandangan alam, gunung, pantai, dan keindahan bumi'],
            ['name' => 'Fantasy',        'slug' => 'fantasy',        'icon' => '🧙', 'color' => '#ec4899', 'description' => 'Dunia fantasi, makhluk mitologi, sihir, dan alam semesta imajinatif'],
            ['name' => 'Cinematic',      'slug' => 'cinematic',      'icon' => '🎬', 'color' => '#f59e0b', 'description' => 'Gaya film sinematik dengan pencahayaan dramatik dan komposisi epik'],
            ['name' => 'Architecture',   'slug' => 'architecture',   'icon' => '🏛️', 'color' => '#10b981', 'description' => 'Bangunan megah, interior mewah, dan desain arsitektur modern'],
            ['name' => 'Nature & Macro', 'slug' => 'nature-macro',   'icon' => '🌿', 'color' => '#84cc16', 'description' => 'Foto makro bunga, serangga, tekstur alam, dan detail alam semesta kecil'],
            ['name' => 'Sci-Fi & Cyber', 'slug' => 'scifi-cyber',    'icon' => '🤖', 'color' => '#3b82f6', 'description' => 'Futuristik, cyberpunk, teknologi, dan dunia fiksi ilmiah'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
