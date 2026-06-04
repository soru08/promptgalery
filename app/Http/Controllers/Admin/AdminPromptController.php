<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminPromptController extends Controller
{
    public function index(Request $request)
    {
        $query = Prompt::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $prompts = $query->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.prompts.index', compact('prompts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $aiTools = ['Midjourney', 'DALL-E 3', 'Stable Diffusion', 'Adobe Firefly', 'Leonardo AI', 'Ideogram', 'Flux'];
        return view('admin.prompts.create', compact('categories', 'aiTools'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prompt_text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'style_tags' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'ai_tool' => 'required|string|max:100',
            'is_featured' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        Prompt::create($validated);

        return redirect()->route('admin.prompts.index')
            ->with('success', 'Prompt berhasil ditambahkan!');
    }

    public function edit(Prompt $prompt)
    {
        $categories = Category::all();
        $aiTools = ['Midjourney', 'DALL-E 3', 'Stable Diffusion', 'Adobe Firefly', 'Leonardo AI', 'Ideogram', 'Flux'];
        return view('admin.prompts.edit', compact('prompt', 'categories', 'aiTools'));
    }

    public function update(Request $request, Prompt $prompt)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prompt_text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'style_tags' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:1000',
            'ai_tool' => 'required|string|max:100',
            'is_featured' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        $prompt->update($validated);

        return redirect()->route('admin.prompts.index')
            ->with('success', 'Prompt berhasil diperbarui!');
    }

    public function destroy(Prompt $prompt)
    {
        $prompt->delete();
        return redirect()->route('admin.prompts.index')
            ->with('success', 'Prompt berhasil dihapus!');
    }
}
