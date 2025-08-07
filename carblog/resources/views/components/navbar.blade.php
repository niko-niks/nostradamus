<nav class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg data-lucide="car" class="h-8 w-8 text-red-500"></svg>
                    <span class="text-xl font-bold text-white">DriveMNL</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Home</a>
                <a href="{{ route('articles.index') }}" class="text-gray-300 hover:text-white transition-colors">Articles</a>

                @auth
                    <a href="{{ route('articles.create') }}" class="text-gray-300 hover:text-white transition-colors">Create Article</a>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-300">{{ Auth::user()->name }}</span>
                        <a href="{{ route('profile.show') }}" class="text-gray-300 hover:text-white transition-colors">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-white transition-colors">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">Register</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-300 hover:text-white">
                    <svg data-lucide="menu" class="h-6 w-6"></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-800 border-t border-gray-700">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Home</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Articles</a>

            @auth
                <a href="{{ route('articles.create') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Create Article</a>
                <div class="px-3 py-2">
                    <span class="text-gray-300">{{ Auth::user()->name }}</span>
                    <a href="{{ route('profile.show') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Profile</a>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-gray-300 hover:text-white transition-colors">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Register</a>
            @endauth
        </div>
    </div>
</nav> 
