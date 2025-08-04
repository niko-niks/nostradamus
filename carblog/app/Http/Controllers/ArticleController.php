<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of articles.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('articles.show', $article->id)->with('success', 'Article created successfully.');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        // Ensure only the owner can edit
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image replacement
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $article->image,
        ]);

        return redirect()->route('articles.show', $article->id)->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
