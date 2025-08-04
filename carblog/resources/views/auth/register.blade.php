@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen bg-gray-900 flex items-center justify-center px-4">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="flex justify-center">
                <div class="bg-red-600 p-3 rounded-full">
                    <svg data-lucide="user-plus" class="h-8 w-8 text-white"></svg>
                </div>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-white">Create Account</h2>
            <p class="mt-2 text-gray-400">Join our automotive community</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="text-gray-300 text-sm font-medium mb-2 block">Full Name</label>
                    <div class="relative">
                        <svg data-lucide="user" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"></svg>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:outline-none transition-colors @error('name') border-red-500 @enderror"
                            placeholder="Enter your full name"
                        >
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="text-gray-300 text-sm font-medium mb-2 block">Email</label>
                    <div class="relative">
                        <svg data-lucide="mail" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"></svg>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:outline-none transition-colors @error('email') border-red-500 @enderror"
                            placeholder="Enter your email"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-gray-300 text-sm font-medium mb-2 block">Password</label>
                    <div class="relative">
                        <svg data-lucide="lock" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"></svg>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:outline-none transition-colors @error('password') border-red-500 @enderror"
                            placeholder="Create a password"
                        >
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="text-gray-300 text-sm font-medium mb-2 block">Confirm Password</label>
                    <div class="relative">
                        <svg data-lucide="lock" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"></svg>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:outline-none transition-colors"
                            placeholder="Confirm your password"
                        >
                    </div>
                </div>
            </div>

            <div class="flex items-center">
                <input 
                    id="terms" 
                    name="terms" 
                    type="checkbox" 
                    required
                    class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-700 rounded bg-gray-800"
                >
                <label for="terms" class="ml-2 text-sm text-gray-400">
                    I agree to the <a href="#" class="text-red-500 hover:text-red-400">Terms of Service</a> and <a href="#" class="text-red-500 hover:text-red-400">Privacy Policy</a>
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-medium transition-colors hover:scale-105 active:scale-95"
            >
                Create Account
            </button>

            <div class="text-center">
                <span class="text-gray-400">Already have an account? </span>
                <a href="{{ route('login') }}" class="text-red-500 hover:text-red-400 font-medium">
                    Sign in
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 