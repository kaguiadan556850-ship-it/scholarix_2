@extends('layouts.app')

@section('title', 'Sign Up - SCHOLARIX')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 py-12">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-xl mb-4">
                <span class="text-white font-bold text-3xl">S</span>
            </div>
            <h1 class="text-3xl font-bold text-primary">SCHOLARIX</h1>
            <p class="text-gray-600 mt-2">Create Student Account</p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Register Form -->
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Enter your full name"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="your.email@example.com"
                >
            </div>

            <div>
                <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">Student ID</label>
                <input
                    type="text"
                    id="student_id"
                    name="student_id"
                    value="{{ old('student_id') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="e.g., 2024-00001"
                >
            </div>

            <div>
                <label for="course" class="block text-sm font-medium text-gray-700 mb-2">Course/Program</label>
                <input
                    type="text"
                    id="course"
                    name="course"
                    value="{{ old('course') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="e.g., BS Computer Science"
                >
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number (Optional)</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="+63 912 345 6789"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Create a password"
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Confirm your password"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-lg transition duration-200 mt-6"
            >
                Create Account
            </button>
        </form>

        <!-- Login Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary hover:underline font-semibold">Login here</a>
            </p>
        </div>
    </div>
</div>
@endsection
