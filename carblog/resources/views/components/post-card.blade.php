<article class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-red-500/20 transition-all duration-300 hover:-translate-y-2 border border-gray-700/50 hover:border-gray-600/50">
    <div class="relative">
        <img
            src="{{ $article->image_url }}"
            alt="{{ $article->title }}"
            class="w-full h-56 object-cover"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        
        <!-- Category Badges with consistent design -->
        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
            @if($article->relationLoaded('categories') || $article->categories)
                @foreach($article->categories->take(2) as $category)
                    <a href="{{ route('articles.category', $category->slug) }}" 
                       class="bg-gradient-to-r from-red-600 to-red-700 text-white px-3 py-1.5 rounded-full text-xs font-semibold hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-lg">
                        {{ $category->name }}
                    </a>
                @endforeach
                @if($article->categories->count() > 2)
                    <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1.5 rounded-full text-xs font-semibold">
                        +{{ $article->categories->count() - 2 }}
                    </span>
                @endif
            @endif
        </div>
        
        @if($article->hot)
            <div class="absolute top-4 right-4">
                <div class="bg-gradient-to-br from-orange-500 to-red-500 text-white p-2.5 rounded-xl shadow-lg">
                    <svg data-lucide="flame" class="h-4 w-4"></svg>
                </div>
            </div>
        @endif
    </div>

    <div class="p-8">
        <a href="{{ route('articles.show', $article->id) }}" class="block">
            <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 hover:text-red-400 transition-all duration-200 cursor-pointer leading-tight">
                {{ $article->title }}
            </h3>
        </a>
        <p class="text-gray-300 mb-6 line-clamp-3 leading-relaxed">{{ $article->excerpt }}</p>

        <!-- Meta Information - Responsive grid for better alignment -->
        <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-sm mt-4">
            <div class="flex items-center space-x-2 min-w-0">
                <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <svg data-lucide="user" class="h-4 w-4 text-white"></svg>
                </div>
                <span class="text-gray-300 font-medium truncate max-w-14 overflow-hidden">{{ $article->user->name ?? 'Unknown' }}</span>
            </div>
            <div class="flex items-center space-x-2 min-w-0">
                <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <svg data-lucide="calendar" class="h-4 w-4 text-white"></svg>
                </div>
                <span class="text-gray-300 font-medium truncate max-w-14 overflow-hidden">{{ $article->created_at->format('M d, Y') }}</span>
            </div>
            <div class="flex items-center space-x-2 min-w-0">
                <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <svg data-lucide="eye" class="h-4 w-4 text-white"></svg>
                </div>
                <span class="text-gray-300 font-medium truncate max-w-10 overflow-hidden">{{ number_format($article->views) }}</span>
            </div>
            <div class="flex items-center space-x-2 min-w-0">
                <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <svg data-lucide="heart" class="h-4 w-4 text-white"></svg>
                </div>
                <span class="text-gray-300 font-medium truncate max-w-10 overflow-hidden">{{ number_format($article->likes) }}</span>
            </div>
        </div>
    </div>

    @if(auth()->check() && auth()->id() === $article->user_id)
        <div class="p-6 border-t border-gray-700/50 flex justify-between items-center bg-gray-800/30">
            <div class="flex items-center space-x-2">
                @if(!$article->published)
                    <span class="text-yellow-400 text-sm font-semibold bg-yellow-400/10 px-3 py-1 rounded-lg">Draft</span>
                @endif
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('articles.edit', $article->id) }}"
                   class="text-yellow-400 hover:text-yellow-300 font-semibold text-sm transition-colors duration-200">
                    Edit
                </a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this article?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-300 font-semibold text-sm transition-colors duration-200">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @endif
</article> 
