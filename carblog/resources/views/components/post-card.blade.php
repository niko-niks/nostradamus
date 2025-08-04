<article class="bg-gray-800 rounded-xl overflow-hidden shadow-2xl hover:shadow-red-500/20 transition-all duration-300 hover:-translate-y-2">
    <div class="relative">
        <img
            src="{{ $post['image'] }}"
            alt="{{ $post['title'] }}"
            class="w-full h-48 object-cover"
        >
        <div class="absolute top-4 left-4">
            <span class="bg-red-600 text-white px-2 py-1 rounded text-sm font-medium">
                {{ $post['category'] }}
            </span>
        </div>
        @if(isset($post['hot']) && $post['hot'])
            <div class="absolute top-4 right-4">
                <div class="bg-orange-500 text-white p-2 rounded-full">
                    <svg data-lucide="flame" class="h-4 w-4"></svg>
                </div>
            </div>
        @endif
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-white mb-3 line-clamp-2 hover:text-red-400 transition-colors cursor-pointer">
            {{ $post['title'] }}
        </h3>
        <p class="text-gray-400 mb-4 line-clamp-3">{{ $post['excerpt'] }}</p>

        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    <svg data-lucide="user" class="h-4 w-4"></svg>
                    <span>{{ $post['author'] }}</span>
                </div>
                <div class="flex items-center space-x-1">
                    <svg data-lucide="calendar" class="h-4 w-4"></svg>
                    <span>{{ \Carbon\Carbon::parse($post['date'])->format('M d, Y') }}</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-1">
                    <svg data-lucide="eye" class="h-4 w-4"></svg>
                    <span>{{ number_format($post['views']) }}</span>
                </div>
                <div class="flex items-center space-x-1">
                    <svg data-lucide="heart" class="h-4 w-4"></svg>
                    <span>{{ number_format($post['likes']) }}</span>
                </div>
            </div>
        </div>
</div>
@if(auth()->check() && auth()->id() === $post['user_id'])
    <div class="p-6 border-t border-gray-700 flex justify-end">
        <a href="{{ route('articles.edit', $post['id']) }}"
           class="text-yellow-400 hover:text-yellow-500 font-medium">
            Edit
        </a>
    </div>
@endif
</article> 
