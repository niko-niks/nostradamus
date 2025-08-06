@extends('layouts.home')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Hero Section -->
    @if($featuredArticle)
        <div class="relative overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="{{ $featuredArticle->image_url }}" 
                     alt="{{ $featuredArticle->title }}"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
            </div>
            
            <!-- Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-8">
                        <!-- Dark transparent background for content -->
                        <div class="bg-black/50 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                            <div class="space-y-8">
                                <!-- Category Badge -->
                                <div class="flex items-center space-x-3">
                                    <span class="inline-block bg-red-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                        Featured Article
                                    </span>
                                    @if($featuredArticle->relationLoaded('categories') || $featuredArticle->categories)
                                        @foreach($featuredArticle->categories->take(1) as $category)
                                            <span class="inline-block bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Title -->
                                <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight">
                                    {{ $featuredArticle->title }}
                                </h1>

                                <!-- Excerpt -->
                                <p class="text-xl text-gray-200 leading-relaxed max-w-2xl">
                                    {{ $featuredArticle->excerpt }}
                                </p>

                                <!-- Meta Information -->
                                <div class="flex items-center space-x-8 text-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                                            <svg data-lucide="user" class="h-5 w-5 text-white"></svg>
                                        </div>
                                        <span class="font-medium">{{ $featuredArticle->author }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                                            <svg data-lucide="calendar" class="h-5 w-5 text-white"></svg>
                                        </div>
                                        <span class="font-medium">{{ $featuredArticle->formatted_date }}</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                                            <svg data-lucide="eye" class="h-5 w-5 text-white"></svg>
                                        </div>
                                        <span class="font-medium">{{ number_format($featuredArticle->views) }} views</span>
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('articles.show', $featuredArticle->id) }}" 
                                       class="inline-block bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-4 rounded-xl font-bold hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                                        Read Full Article
                                    </a>
                                    <a href="{{ route('articles.show', $featuredArticle->id) }}" 
                                       class="inline-block bg-white/10 backdrop-blur-sm text-white px-6 py-4 rounded-xl font-semibold hover:bg-white/20 transition-all duration-200">
                                        Learn More →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="relative">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img src="{{ $featuredArticle->image_url }}" 
                                 alt="{{ $featuredArticle->title }}"
                                 class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            
                            <!-- Floating Stats -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-black/50 backdrop-blur-sm rounded-xl p-4">
                                    <div class="flex items-center justify-between text-white">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center space-x-2">
                                                <svg data-lucide="heart" class="h-5 w-5 text-red-400"></svg>
                                                <span class="font-semibold">{{ number_format($featuredArticle->like_count) }}</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <svg data-lucide="eye" class="h-5 w-5 text-blue-400"></svg>
                                                <span class="font-semibold">{{ number_format($featuredArticle->views) }}</span>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-300">
                                            Featured Story
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <!-- Categories Section -->
        <section class="mb-20">
            <div class="flex items-center space-x-4 mb-12">
                <div class="bg-red-600 p-3 rounded-xl shadow-lg">
                    <svg data-lucide="grid" class="h-6 w-6 text-white"></svg>
                </div>
                <h2 class="text-4xl font-bold text-white">Categories</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('articles.category', $category->slug) }}" 
                       class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 text-center hover:from-gray-700 hover:to-gray-800 transition-all duration-300 group border border-gray-700/50 hover:border-gray-600/50 shadow-lg hover:shadow-xl hover:scale-105">
                        <div class="text-3xl mb-4">
                            <div class="bg-red-600 p-3 rounded-xl shadow-lg mx-auto w-fit">
                                @php
                                    // Map icon names to valid Lucide icons
                                    $iconMap = [
                                        'tool' => 'wrench',
                                        'car' => 'car',
                                        'flame' => 'flame',
                                        'clock' => 'clock',
                                        'grid' => 'grid',
                                        'user' => 'user',
                                        'heart' => 'heart',
                                        'eye' => 'eye',
                                        'calendar' => 'calendar',
                                        'search' => 'search',
                                        'edit' => 'edit',
                                        'trash' => 'trash',
                                        'plus' => 'plus',
                                        'minus' => 'minus',
                                        'check' => 'check',
                                        'x' => 'x',
                                        'menu' => 'menu',
                                        'log-in' => 'log-in',
                                        'user-plus' => 'user-plus',
                                        'mail' => 'mail',
                                        'lock' => 'lock',
                                        'file-text' => 'file-text',
                                        'settings' => 'settings',
                                        'star' => 'star',
                                        'thumbs-up' => 'thumbs-up',
                                        'share' => 'share',
                                        'bookmark' => 'bookmark',
                                        'tag' => 'tag',
                                        'folder' => 'folder',
                                        'image' => 'image',
                                        'video' => 'video',
                                        'music' => 'music',
                                        'download' => 'download',
                                        'upload' => 'upload',
                                        'link' => 'link',
                                        'external-link' => 'external-link',
                                        'home' => 'home',
                                        'info' => 'info',
                                        'help-circle' => 'help-circle',
                                        'alert-circle' => 'alert-circle',
                                        'check-circle' => 'check-circle',
                                        'x-circle' => 'x-circle',
                                        'chevron-right' => 'chevron-right',
                                        'chevron-left' => 'chevron-left',
                                        'chevron-up' => 'chevron-up',
                                        'chevron-down' => 'chevron-down',
                                        'arrow-right' => 'arrow-right',
                                        'arrow-left' => 'arrow-left',
                                        'arrow-up' => 'arrow-up',
                                        'arrow-down' => 'arrow-down',
                                        // Category-specific icons
                                        'zap' => 'zap',
                                        'trophy' => 'trophy',
                                        'crown' => 'crown',
                                        'battery' => 'battery',
                                        'wrench' => 'wrench',
                                        'flag' => 'flag',
                                        'newspaper' => 'newspaper',
                                        'book-open' => 'book-open',
                                        'settings' => 'settings',
                                    ];
                                    $iconName = $iconMap[$category->icon] ?? 'circle';
                                @endphp
                                <svg data-lucide="{{ $iconName }}" class="h-8 w-8 text-white"></svg>
                            </div>
                        </div>
                        <h3 class="text-white font-bold text-lg mb-2">{{ $category->name }}</h3>
                        <p class="text-gray-300 text-sm font-medium">{{ $category->articles_count }} articles</p>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Latest Articles Section -->
        @if($latestArticles->count() > 0)
            <section class="mb-20">
                <div class="flex items-center justify-between mb-12">
                    <div class="flex items-center space-x-4">
                        <div class="bg-red-600 p-3 rounded-xl shadow-lg">
                            <svg data-lucide="clock" class="h-6 w-6 text-white"></svg>
                        </div>
                        <h2 class="text-4xl font-bold text-white">Latest Articles</h2>
                    </div>
                    <a href="{{ route('articles.index') }}" 
                       class="text-red-400 hover:text-red-300 font-bold transition-all duration-200 hover:scale-105">
                        View All Articles →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestArticles as $article)
                        <x-post-card :article="$article" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Hot Articles Section -->
        @if($hotArticles->count() > 0)
            <section class="mb-20">
                <div class="flex items-center justify-between mb-12">
                    <div class="flex items-center space-x-4">
                        <div class="bg-orange-500 p-3 rounded-xl shadow-lg">
                            <svg data-lucide="flame" class="h-6 w-6 text-white"></svg>
                        </div>
                        <h2 class="text-4xl font-bold text-white">What's Hot</h2>
                    </div>
                    <a href="{{ route('articles.index') }}" 
                       class="text-red-400 hover:text-red-300 font-bold transition-all duration-200 hover:scale-105">
                        View All Articles →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($hotArticles as $article)
                        <x-post-card :article="$article" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Call to Action -->
        @auth
            <div class="mt-20 text-center">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl p-12 border border-gray-700/50 shadow-2xl">
                    <h3 class="text-3xl font-bold text-white mb-6">Share Your Story</h3>
                    <p class="text-gray-300 mb-8 text-lg leading-relaxed">Join our community and share your insights with the world</p>
                    <a href="{{ route('articles.create') }}" 
                       class="inline-block bg-gradient-to-r from-red-600 to-red-700 text-white px-10 py-4 rounded-xl font-bold hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                        Create Your First Article
                    </a>
                </div>
            </div>
        @else
            <div class="mt-20 text-center">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl p-12 border border-gray-700/50 shadow-2xl">
                    <h3 class="text-3xl font-bold text-white mb-6">Join Our Community</h3>
                    <p class="text-gray-300 mb-8 text-lg leading-relaxed">Sign up to create articles and engage with other writers</p>
                    <div class="flex items-center justify-center space-x-6">
                        <a href="{{ route('register') }}" 
                           class="inline-block bg-gradient-to-r from-red-600 to-red-700 text-white px-10 py-4 rounded-xl font-bold hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                            Sign Up
                        </a>
                        <a href="{{ route('login') }}" 
                           class="inline-block bg-gradient-to-r from-gray-600 to-gray-700 text-white px-10 py-4 rounded-xl font-bold hover:from-gray-700 hover:to-gray-800 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</div>
@endsection 