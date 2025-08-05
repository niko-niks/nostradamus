<!-- resources/views/articles/_form.blade.php -->
<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label class="block text-white font-semibold mb-3">Title *</label>
        <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}"
               class="w-full border-2 border-gray-600 rounded-xl p-4 bg-gray-700/50 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200"
               placeholder="Enter article title">
        @error('title')
            <p class="text-red-400 text-sm mt-2 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-white font-semibold mb-3">Categories *</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($categories as $category)
                <label class="flex items-center space-x-3 cursor-pointer p-3 bg-gray-700/50 rounded-xl border border-gray-600 hover:border-gray-500 transition-all duration-200">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                           {{ in_array($category->id, old('categories', $article && $article->relationLoaded('categories') ? $article->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                           class="rounded border-gray-600 text-red-600 focus:ring-red-500 bg-gray-700">
                    <span class="text-sm text-gray-200 font-medium">{{ $category->name }}</span>
                </label>
            @endforeach
        </div>
        @error('categories')
            <p class="text-red-400 text-sm mt-2 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-white font-semibold mb-3">Excerpt</label>
        <textarea name="excerpt" rows="3"
                  class="w-full border-2 border-gray-600 rounded-xl p-4 bg-gray-700/50 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200"
                  placeholder="Brief description of the article (optional)">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
        @error('excerpt')
            <p class="text-red-400 text-sm mt-2 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-white font-semibold mb-3">Content *</label>
        <textarea name="content" rows="12"
                  class="w-full border-2 border-gray-600 rounded-xl p-4 bg-gray-700/50 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all duration-200"
                  placeholder="Write your article content here...">{{ old('content', $article->content ?? '') }}</textarea>
        @error('content')
            <p class="text-red-400 text-sm mt-2 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center space-x-8">
        <div class="flex items-center">
            <input type="checkbox" name="hot" value="1" 
                   {{ old('hot', $article->hot ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-600 rounded bg-gray-700">
            <label class="ml-3 block text-sm text-gray-200 font-medium">
                Mark as Hot Article
            </label>
        </div>
        
        <div class="flex items-center">
            <input type="checkbox" name="published" value="1" 
                   {{ old('published', $article->published ?? true) ? 'checked' : '' }}
                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-600 rounded bg-gray-700">
            <label class="ml-3 block text-sm text-gray-200 font-medium">
                Publish immediately
            </label>
        </div>
    </div>

    <div class="flex items-center justify-between pt-6">
        <a href="{{ route('articles.index') }}" 
           class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-8 py-3 rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-200 font-semibold shadow-lg">
            Cancel
        </a>
        <button type="submit"
            class="bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
            {{ $buttonText }}
        </button>
    </div>
</form>
