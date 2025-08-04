<div class="mb-8">
    <div class="flex items-center space-x-4 mb-4">
        <svg data-lucide="filter" class="h-5 w-5 text-gray-400"></svg>
        <h3 class="text-lg font-semibold text-white">Filter by Category</h3>
    </div>
    <div class="flex flex-wrap gap-2">
        @foreach($categories as $category)
            <a 
                href="{{ request()->fullUrlWithQuery(['category' => $category === 'All' ? '' : $category]) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition-colors hover:scale-105 active:scale-95 {{ request('category', 'All') === $category ? 'bg-red-600 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white' }}"
            >
                {{ $category }}
            </a>
        @endforeach
    </div>
</div> 