<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();

        // Get all articles created by the user
        $articles = Article::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('users.profile', compact('user', 'articles'));
    }
}
