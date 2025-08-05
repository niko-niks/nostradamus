@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center px-4 py-8">
    <div class="max-w-md w-full">
        <!-- Enhanced Card Design -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl border border-gray-700/50 p-8 backdrop-blur-sm">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 p-4 rounded-2xl shadow-lg">
                        <svg data-lucide="user-plus" class="h-8 w-8 text-white"></svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
                <p class="text-gray-300">Join our automotive community</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-5">
                    <div>
                        <label for="name" class="text-white text-sm font-semibold mb-3 block">Full Name</label>
                        <div class="flex items-center gap-3">
                            <svg data-lucide="user" class="h-5 w-5 text-gray-400"></svg>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full pr-4 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-xl text-white placeholder-gray-300 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 transition-all duration-200 @error('name') border-red-500 @enderror"
                                placeholder="Enter your full name"
                            >
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

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
                                placeholder="Create a password"
                            >
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="text-white text-sm font-semibold mb-3 block">Confirm Password</label>
                        <div class="flex items-center gap-3">
                            <svg data-lucide="lock" class="h-5 w-5 text-gray-400"></svg>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                class="w-full pr-4 py-4 bg-gray-700/50 border-2 border-gray-600 rounded-xl text-white placeholder-gray-300 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20 transition-all duration-200"
                                placeholder="Confirm your password"
                            >
                        </div>
                    </div>
                </div>

                <div class="flex items-start">
                    <input 
                        id="terms" 
                        name="terms" 
                        type="checkbox" 
                        required
                        class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-600 rounded bg-gray-700 mt-1"
                    >
                    <label for="terms" class="ml-3 text-sm text-gray-300 font-medium leading-relaxed">
                        I agree to the <a href="#" class="text-red-400 hover:text-red-300 font-semibold">Terms of Service</a> and <a href="#" class="text-red-400 hover:text-red-300 font-semibold">Privacy Policy</a>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-4 rounded-xl font-semibold transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl"
                >
                    Create Account
                </button>

                <div class="text-center pt-4">
                    <span class="text-gray-300">Already have an account? </span>
                    <a href="{{ route('login') }}" class="text-red-400 hover:text-red-300 font-semibold transition-colors">
                        Sign in
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 