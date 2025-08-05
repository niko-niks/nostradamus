@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full">
        <!-- Enhanced Card Design -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700/50 p-8 backdrop-blur-sm">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 p-4 rounded-2xl shadow-lg">
                        <svg data-lucide="log-in" class="h-8 w-8 text-white"></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
                <p class="text-gray-300">Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-5">
                    <div>
                        <label for="email" class="text-white text-sm font-semibold mb-3 block">Email Address</label>
                        <div class="flex items-center gap-3">
                            <svg data-lucide="mail" class="h-5 w-5 text-gray-400"></svg>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="w-full pr-4 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-xl text-white placeholder-gray-300 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 transition-all duration-200 @error('email') border-red-500 @enderror"
                                placeholder="Enter your email"
                            >
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="text-white text-sm font-semibold mb-3 block">Password</label>
                        <div class="flex items-center gap-3">
                            <svg data-lucide="lock" class="h-5 w-5 text-gray-400"></svg>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="w-full pr-4 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-xl text-white placeholder-gray-300 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Enter your password"
                            >
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-600 rounded bg-gray-700"
                        >
                        <label for="remember" class="ml-3 text-sm text-gray-300 font-medium">
                            Remember me
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-400 hover:text-red-300 font-medium transition-colors">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-4 rounded-xl font-semibold transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl"
                >
                    Sign In
                </button>

                <div class="text-center pt-4">
                    <span class="text-gray-300">Don't have an account? </span>
                    <a href="{{ route('register') }}" class="text-red-400 hover:text-red-300 font-semibold transition-colors">
                        Sign up
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 