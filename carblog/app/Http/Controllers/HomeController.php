<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get featured article (most viewed in the last 30 days)
        $featuredArticle = Article::published()
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('views', 'desc')
            ->first();

        // Get hot articles
        $hotArticles = Article::published()
            ->hot()
            ->latest()
            ->take(6)
            ->get();

        // Get latest articles
        $latestArticles = Article::published()
            ->with('user')
            ->latest()
            ->take(6)
            ->get();

        // Get categories with article counts
        $categories = Category::withCount('articles')->get();

        return view('home', compact('featuredArticle', 'hotArticles', 'latestArticles', 'categories'));
    }
} 