@extends('layouts.home')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Article Header -->
    <div class="bg-gradient-to-r from-red-900 to-red-700 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center flex-wrap gap-2 mb-4">
                    @if($article->relationLoaded('categories') || $article->categories)
                        @foreach($article->categories as $category)
                            <a href="{{ route('articles.category', $category->slug) }}" 
                               class="inline-block bg-red-600 text-white px-3 py-1 rounded-full text-sm font-medium hover:bg-red-700 transition-colors">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
                <h1 class="text-4xl font-bold text-white mb-4 break-words">{{ $article->title }}</h1>
                <div class="flex items-center justify-center space-x-6 text-red-100">
                    <div class="flex items-center space-x-2">
                        <svg data-lucide="user" class="h-5 w-5"></svg>
                        <span>{{ $article->author }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg data-lucide="calendar" class="h-5 w-5"></svg>
                        <span>{{ $article->formatted_date }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg data-lucide="eye" class="h-5 w-5"></svg>
                        <span>{{ number_format($article->views) }} views</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg data-lucide="heart" class="h-5 w-5"></svg>
                        <span id="likes-count">{{ number_format($article->like_count) }} likes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <article class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                    <img src="{{ $article->image_url }}" 
                         alt="{{ $article->title }}"
                         class="w-full h-64 object-cover rounded-xl mb-8">

                    @if($article->excerpt)
                        <div class="bg-gray-700/50 rounded-xl p-6 mb-8 border border-gray-600/50">
                            <p class="text-gray-200 italic text-lg leading-relaxed break-words">{{ $article->excerpt }}</p>
                        </div>
                    @endif

                    <div class="prose prose-invert max-w-none text-gray-200 leading-relaxed break-words overflow-hidden">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <!-- Article Actions -->
                    <div class="mt-8 pt-8 border-t border-gray-700/50 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @auth
                                <button onclick="toggleLike({{ $article->id }})" 
                                        id="like-button"
                                        class="flex items-center space-x-2 bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg {{ $article->isLikedBy(auth()->user()) ? 'bg-gradient-to-r from-pink-600 to-pink-700' : '' }}">
                                    <svg data-lucide="heart" class="h-5 w-5" id="heart-icon"></svg>
                                    <span id="likes-count-inline">{{ number_format($article->like_count) }}</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="flex items-center space-x-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-3 rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-200 font-semibold shadow-lg">
                                    <svg data-lucide="heart" class="h-5 w-5"></svg>
                                    <span>{{ number_format($article->like_count) }}</span>
                                </a>
                            @endauth
                        </div>

                        @if(auth()->check() && auth()->id() === $article->user_id)
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('articles.edit', $article->id) }}" 
                                   class="text-yellow-400 hover:text-yellow-300 font-semibold transition-colors duration-200">
                                    Edit Article
                                </a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this article?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 font-semibold transition-colors duration-200">
                                        Delete Article
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-2xl sticky top-6">
                    <!-- Author Info -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-4">About the Author</h3>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold">{{ substr($article->author, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-white font-semibold break-words">{{ $article->author }}</p>
                                <p class="text-gray-300 text-sm">Article Author</p>
                            </div>
                        </div>
                    </div>

                    <!-- Related Articles -->
                    @if($relatedArticles->count() > 0)
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4">Related Articles</h3>
                            <div class="space-y-4">
                                @foreach($relatedArticles as $relatedArticle)
                                    <a href="{{ route('articles.show', $relatedArticle->id) }}" 
                                       class="block group">
                                        <div class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-700/50 transition-all duration-200">
                                            <img src="{{ $relatedArticle->image_url }}" 
                                                 alt="{{ $relatedArticle->title }}"
                                                 class="w-16 h-12 object-cover rounded-lg">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm text-gray-200 group-hover:text-red-400 transition-colors line-clamp-2 font-medium break-words">
                                                    {{ $relatedArticle->title }}
                                                </p>
                                                <p class="text-xs text-gray-400">
                                                    {{ $relatedArticle->formatted_date }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Back to Articles -->
                    <div class="mt-8 pt-6 border-t border-gray-700/50">
                        <a href="{{ route('articles.index') }}" 
                           class="w-full bg-gradient-to-r from-gray-600 to-gray-700 text-white py-3 px-4 rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-200 text-center block font-semibold shadow-lg">
                            Back to Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleLike(articleId) {
    fetch(`/articles/${articleId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
            return;
        }
        
        // Update like count displays
        document.getElementById('likes-count').textContent = data.likes.toLocaleString() + ' likes';
        document.getElementById('likes-count-inline').textContent = data.likes.toLocaleString();
        
        // Update button appearance
        const likeButton = document.getElementById('like-button');
        const heartIcon = document.getElementById('heart-icon');
        
        if (data.liked) {
            likeButton.className = 'flex items-center space-x-2 bg-gradient-to-r from-pink-600 to-pink-700 text-white px-6 py-3 rounded-xl hover:from-pink-700 hover:to-pink-800 transition-all duration-200 font-semibold shadow-lg';
            heartIcon.style.fill = 'currentColor';
        } else {
            likeButton.className = 'flex items-center space-x-2 bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg';
            heartIcon.style.fill = 'none';
        }
        
        // Show feedback message
        const message = data.message;
        if (message) {
            // You could show a toast notification here
            console.log(message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your like.');
    });
}

// Initialize heart icon fill based on current like status
document.addEventListener('DOMContentLoaded', function() {
    @auth
        @if($article->isLikedBy(auth()->user()))
            const heartIcon = document.getElementById('heart-icon');
            if (heartIcon) {
                heartIcon.style.fill = 'currentColor';
            }
        @endif
    @endauth
});
</script>
@endsection 