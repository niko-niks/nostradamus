@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('components.hero-section', ['featuredPost' => $featuredPost])

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @include('components.filter-section', ['categories' => $categories])

        <!-- Recent Posts Section -->
        <section class="mb-16">
            <div class="flex items-center space-x-3 mb-8">
                <svg data-lucide="clock" class="h-6 w-6 text-red-500"></svg>
                <h2 class="text-3xl font-bold text-white">Recent Posts</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($filteredPosts->take(6) as $index => $post)
                    @include('components.post-card', ['post' => $post, 'index' => $index])
                @endforeach
            </div>
        </section>

        <!-- What's Hot Section -->
        <section>
            <div class="flex items-center space-x-3 mb-8">
                <svg data-lucide="flame" class="h-6 w-6 text-orange-500"></svg>
                <h2 class="text-3xl font-bold text-white">What's Hot</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($hotPosts as $index => $post)
                    @include('components.post-card', ['post' => $post, 'index' => $index])
                @endforeach
            </div>
        </section>
    </div>
@endsection 