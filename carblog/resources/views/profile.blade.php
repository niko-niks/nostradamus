@extends('layouts.home')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <!-- Profile Header -->
    <div class="bg-white rounded shadow p-6 mb-8 flex items-center space-x-6">
        <img src="{{ $user->avatar ?? asset('default-avatar.png') }}"
             alt="Profile picture"
             class="w-24 h-24 rounded-full object-cover">
        <div>
            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="text-sm text-gray-500 mt-1">Joined {{ $user->created_at->format('F Y') }}</p>
        </div>
    </div>

    <!-- User's Articles -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">My Articles</h2>
        @if($articles->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($articles as $post)
                    @include('components.post-card', ['post' => $post])
                @endforeach
            </div>
        @else
            <p class="text-gray-600">You haven’t posted any articles yet.</p>
        @endif
    </div>
</div>
@endsection
