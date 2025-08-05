<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'category']);
    }

    /**
     * Display a listing of articles.
     */
    public function index()
    {
        $articles = Article::published()
            ->with(['user', 'categories'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('articles')->get();
        $hotArticles = Article::published()->hot()->latest()->take(3)->get();

        return view('articles.index', compact('articles', 'categories', 'hotArticles'));
    }

    /**
     * Display articles by category.
     */
    public function category($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        
        $articles = Article::published()
            ->byCategory($categorySlug)
            ->with(['user', 'categories'])
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('articles')->get();
        $hotArticles = Article::published()->hot()->latest()->take(3)->get();

        return view('articles.index', compact('articles', 'categories', 'hotArticles', 'category'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        if (!$article->published && $article->user_id !== Auth::id()) {
            abort(404);
        }

        // Load categories for the article
        $article->load('categories');

        // Increment view count
        $article->incrementViews();

        // Get related articles based on shared categories
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->whereHas('categories', function ($query) use ($article) {
                $query->whereIn('categories.id', $article->categories->pluck('id'));
            })
            ->with(['user', 'categories'])
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = Category::all();
        $article = new Article();
        return view('articles.create', compact('categories', 'article'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'hot' => 'boolean',
            'published' => 'boolean',
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'image' => Article::getRandomCarImage(),
            'user_id' => Auth::id(),
            'hot' => $request->boolean('hot', false),
            'published' => $request->boolean('published', true),
        ]);

        // Attach categories
        $article->categories()->attach($validated['categories']);

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        // Ensure only the owner can edit
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'hot' => 'boolean',
            'published' => 'boolean',
        ]);

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'hot' => $request->boolean('hot', false),
            'published' => $request->boolean('published', true),
        ]);

        // Sync categories
        $article->categories()->sync($validated['categories']);

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    /**
     * Toggle like for an article.
     */
    public function like(Article $article)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to like articles'], 401);
        }

        $isLiked = $article->toggleLike(Auth::user());
        
        return response()->json([
            'liked' => $isLiked,
            'likes' => $article->fresh()->like_count,
            'message' => $isLiked ? 'Article liked!' : 'Article unliked!'
        ]);
    }
}
