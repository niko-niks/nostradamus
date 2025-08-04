@extends('layouts.home')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Create New Article</h1>

    @include('articles._form', [
        'action' => route('articles.store'),
        'method' => 'POST',
        'buttonText' => 'Create Article'
    ])
</div>
@endsection
