@extends('layouts.home')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-red-900 to-red-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4 break-words">
                    @if(isset($category))
                        {{ $category->name }} Articles
                    @else
                        Latest Articles
                    @endif
                </h1>
                <p class="text-xl text-red-100">
                    Discover amazing stories and insights from our community
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-2xl sticky top-6">
                    <!-- Categories -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-4">Categories</h3>
                        <div class="space-y-3">
                            <a href="{{ route('articles.index') }}" 
                               class="block text-gray-300 hover:text-red-400 transition-all duration-200 font-medium {{ !isset($category) ? 'text-red-400 font-semibold' : '' }}">
                                All Articles
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('articles.category', $cat->slug) }}" 
                                   class="block text-gray-300 hover:text-red-400 transition-all duration-200 font-medium {{ isset($category) && $category->id === $cat->id ? 'text-red-400 font-semibold' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Hot Articles -->
                    @if($hotArticles->count() > 0)
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4">Hot Articles</h3>
                            <div class="space-y-4">
                                @foreach($hotArticles as $hotArticle)
                                    <a href="{{ route('articles.show', $hotArticle->id) }}" 
                                       class="block group">
                                        <div class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-700/50 transition-all duration-200">
                                            <img src="{{ $hotArticle->image_url }}" 
                                                 alt="{{ $hotArticle->title }}"
                                                 class="w-12 h-12 object-cover rounded-lg">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm text-gray-200 group-hover:text-red-400 transition-colors line-clamp-2 font-medium break-words">
                                                    {{ $hotArticle->title }}
                                                </p>
                                                <p class="text-xs text-gray-400">
                                                    {{ $hotArticle->formatted_date }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Create Article Button -->
                    @auth
                        <div class="mt-8 pt-6 border-t border-gray-700/50">
                            <a href="{{ route('articles.create') }}" 
                               class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-4 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 text-center block font-semibold shadow-lg">
                                Create Article
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                @if(session('success'))
                    <div class="bg-green-600 text-white p-4 rounded-xl mb-6 shadow-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($articles as $article)
                            <x-post-card :article="$article" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $articles->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
                            <svg data-lucide="file-text" class="h-16 w-16 text-gray-500 mx-auto mb-4"></svg>
                            <h3 class="text-xl font-bold text-white mb-2">No Articles Found</h3>
                            <p class="text-gray-300 mb-6">
                                @if(isset($category))
                                    No articles found in the {{ $category->name }} category.
                                @else
                                    No articles have been published yet.
                                @endif
                            </p>
                            @auth
                                <a href="{{ route('articles.create') }}" 
                                   class="bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-6 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg">
                                    Create First Article
                                </a>
                            @else
                                <a href="{{ route('login') }}" 
                                   class="bg-gradient-to-r from-red-600 to-red-700 text-white py-3 px-6 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg">
                                    Login to Create
                                </a>
                            @endauth
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 