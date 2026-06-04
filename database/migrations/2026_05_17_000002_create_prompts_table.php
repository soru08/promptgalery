<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('prompt_text');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('style_tags')->nullable();
            $table->text('description')->nullable();
            $table->string('ai_tool')->default('Midjourney'); // Midjourney, DALL-E, Stable Diffusion, etc.
            $table->boolean('is_featured')->default(false);
            $table->integer('copy_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }
};
