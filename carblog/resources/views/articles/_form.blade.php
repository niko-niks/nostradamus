<!-- resources/views/articles/_form.blade.php -->
<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label class="block text-gray-700 font-semibold">Title</label>
        <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}"
               class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-gray-700 font-semibold">Content</label>
        <textarea name="content" rows="5"
                  class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content', $article->content ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-gray-700 font-semibold">Image</label>
        <input type="file" name="image" class="block mt-1">
        @if(!empty($article->image))
            <p class="text-sm text-gray-500 mt-1">Current: {{ $article->image }}</p>
        @endif
    </div>

    <button type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        {{ $buttonText }}
    </button>
</form>
