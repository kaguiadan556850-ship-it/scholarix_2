@extends('layouts.student')

@section('title', 'My Profile - SCHOLARIX')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
        <p class="text-gray-600 mt-2">Manage your personal information</p>
    </div>

    <!-- Profile Form -->
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email (Read-only)</label>
                    <input
                        type="email"
                        id="email"
                        value="{{ $user->email }}"
                        disabled
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                    >
                </div>

                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">Student ID (Read-only)</label>
                    <input
                        type="text"
                        id="student_id"
                        value="{{ $user->student_id }}"
                        disabled
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                    >
                </div>

                <div>
                    <label for="course" class="block text-sm font-medium text-gray-700 mb-2">Course/Program</label>
                    <input
                        type="text"
                        id="course"
                        name="course"
                        value="{{ old('course', $user->course) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>

                <div>
                    <label for="gpa" class="block text-sm font-medium text-gray-700 mb-2">GPA (Optional)</label>
                    <input
                        type="number"
                        id="gpa"
                        name="gpa"
                        step="0.01"
                        min="0"
                        max="5"
                        value="{{ old('gpa', $user->gpa) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                >{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <button
                    type="submit"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-lg transition"
                >
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
