<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use App\Models\Category;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('prompts')->get();

        $query = Prompt::with('category')->latest();

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('prompt_text', 'like', '%' . $request->search . '%')
                  ->orWhere('style_tags', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('ai_tool')) {
            $query->where('ai_tool', $request->ai_tool);
        }

        $prompts = $query->paginate(12)->withQueryString();

        $featuredPrompts = Prompt::with('category')->where('is_featured', true)->take(4)->get();

        return view('welcome', compact('prompts', 'categories', 'featuredPrompts'));
    }

    public function incrementCopy(Prompt $prompt)
    {
        $prompt->incrementCopyCount();
        return response()->json(['success' => true, 'count' => $prompt->fresh()->copy_count]);
    }
}
