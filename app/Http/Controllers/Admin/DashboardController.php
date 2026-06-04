<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPrompts = Prompt::count();
        $totalCategories = Category::count();
        $featuredPrompts = Prompt::where('is_featured', true)->count();
        $totalCopies = Prompt::sum('copy_count');
        $recentPrompts = Prompt::with('category')->latest()->take(5)->get();
        $popularPrompts = Prompt::with('category')->orderBy('copy_count', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPrompts',
            'totalCategories',
            'featuredPrompts',
            'totalCopies',
            'recentPrompts',
            'popularPrompts'
        ));
    }
}
