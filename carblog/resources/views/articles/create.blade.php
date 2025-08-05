@extends('layouts.home')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 border border-gray-700/50 shadow-2xl">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Create New Article</h1>
                <p class="text-gray-300">Share your thoughts and insights with the community</p>
            </div>

            @include('articles._form', [
                'action' => route('articles.store'),
                'method' => 'POST',
                'buttonText' => 'Create Article',
                'categories' => $categories
            ])
        </div>
    </div>
</div>
@endsection
