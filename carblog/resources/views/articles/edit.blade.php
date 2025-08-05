@extends('layouts.home')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 rounded-xl p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Edit Article</h1>
                <p class="text-gray-400">Update your article content and settings</p>
            </div>

            @include('articles._form', [
                'action' => route('articles.update', $article->id),
                'method' => 'PUT',
                'buttonText' => 'Update Article',
                'article' => $article,
                'categories' => $categories
            ])
        </div>
    </div>
</div>
@endsection
