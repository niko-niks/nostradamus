<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $featuredPost['image'] }}"
            alt="{{ $featuredPost['title'] }}"
            class="w-full h-full object-cover"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="mb-6">
                <span class="inline-block bg-red-600 text-white px-3 py-1 rounded-full text-sm font-medium mb-4">
                    Featured
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $featuredPost['title'] }}
                </h1>
                <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                    {{ $featuredPost['excerpt'] }}
                </p>
            </div>

            <div class="flex items-center space-x-6 mb-8">
                <div class="flex items-center space-x-2 text-gray-300">
                    <svg data-lucide="user" class="h-4 w-4"></svg>
                    <span>{{ $featuredPost['author'] }}</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-300">
                    <svg data-lucide="calendar" class="h-4 w-4"></svg>
                    <span>{{ \Carbon\Carbon::parse($featuredPost['date'])->format('M d, Y') }}</span>
                </div>
                <div class="flex items-center space-x-2 text-gray-300">
                    <svg data-lucide="eye" class="h-4 w-4"></svg>
                    <span>{{ number_format($featuredPost['views']) }}</span>
                </div>
            </div>

            <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg font-medium text-lg transition-colors flex items-center space-x-2 hover:scale-105 active:scale-95 inline-block">
                <span>Read Full Article</span>
                <svg data-lucide="chevron-right" class="h-5 w-5"></svg>
            </a>
        </div>
    </div>
</section> 