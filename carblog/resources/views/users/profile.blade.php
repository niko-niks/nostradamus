@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-red-500">Welcome, {{ $user->name }}</h1>

    <h2 class="text-xl font-semibold mb-2">Your Articles</h2>
    @if($articles->isEmpty())
        <p>You haven't written any articles yet.</p>
    @else
        <ul class="space-y-2">
            @foreach($articles as $article)
                <li class="border p-3 rounded text-white cursor-pointer bg-gray-800 hover:bg-gray-900 transition">
                    <h3 class="text-lg font-semibold">{{ $article->title }}</h3>
                    <p class="text-gray-600 text-sm">{{ $article->created_at->format('F j, Y') }}</p>
                    <a href="{{ route('articles.show', $article->id) }}" class="text-red-500 hover:underline">Read more</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
