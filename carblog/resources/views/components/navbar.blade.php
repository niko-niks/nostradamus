<nav class="bg-gray-900/95 backdrop-blur-sm border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-2 cursor-pointer hover:scale-105 transition-transform">
                <svg data-lucide="car" class="h-8 w-8 text-red-500"></svg>
                <span class="text-xl font-bold text-white">DriveMNL</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-red-500' : 'text-gray-300 hover:text-white' }}">
                    Home
                </a>
                <a href="#" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Reviews</a>
                <a href="#" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Classic Cars</a>
                <a href="#" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Track Tests</a>
                <a href="#" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">News</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <svg data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></svg>
                    <input
                        type="text"
                        placeholder="Search..."
                        class="bg-gray-800 text-white pl-10 pr-4 py-2 rounded-lg border border-gray-700 focus:border-red-500 focus:outline-none w-64"
                    >
                </div>
                <a href="{{ route('login') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors hover:scale-105 active:scale-95">
                    Login
                </a>
            </div>

            <button
                id="mobile-menu-button"
                class="md:hidden text-white"
            >
                <svg data-lucide="menu" class="h-6 w-6"></svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-800 mt-2 pt-2 pb-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('home') }}" class="text-left text-gray-300 hover:text-white py-2">
                    Home
                </a>
                <a href="#" class="text-left text-gray-300 hover:text-white py-2">Reviews</a>
                <a href="#" class="text-left text-gray-300 hover:text-white py-2">Classic Cars</a>
                <a href="#" class="text-left text-gray-300 hover:text-white py-2">Track Tests</a>
                <a href="#" class="text-left text-gray-300 hover:text-white py-2">News</a>
                <div class="pt-2 border-t border-gray-800">
                    <a href="{{ route('login') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium w-full block text-center">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav> 