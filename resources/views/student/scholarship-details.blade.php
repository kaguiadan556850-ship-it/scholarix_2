@extends('layouts.student')

@section('title', $scholarship->name . ' - SCHOLARIX')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('student.scholarships') }}" class="inline-flex items-center text-primary hover:underline">
        ← Back to Scholarships
    </a>

    <!-- Scholarship Details -->
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $scholarship->name }}</h1>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <span class="text-gray-600">Amount:</span>
                <p class="font-semibold text-2xl text-primary">₱{{ number_format($scholarship->amount, 2) }}</p>
            </div>
            <div>
                <span class="text-gray-600">Deadline:</span>
                <p class="font-semibold text-lg">{{ $scholarship->deadline->format('M d, Y') }}</p>
            </div>
            <div>
                <span class="text-gray-600">Available Slots:</span>
                <p class="font-semibold text-lg">{{ $scholarship->slots - $scholarship->slots_filled }} / {{ $scholarship->slots }}</p>
            </div>
            @if($scholarship->category)
            <div>
                <span class="text-gray-600">Category:</span>
                <p class="font-semibold text-lg">{{ $scholarship->category }}</p>
            </div>
            @endif
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-gray-900 mb-2">Description:</h3>
            <p class="text-gray-700">{{ $scholarship->description }}</p>
        </div>

        @if($scholarship->requirements)
        <div class="mb-6">
            <h3 class="font-semibold text-gray-900 mb-2">Requirements:</h3>
            <p class="text-gray-700 whitespace-pre-line">{{ $scholarship->requirements }}</p>
        </div>
        @endif
    </div>

    <!-- Application Form -->
    @if(!$hasApplied)
        <div class="bg-white rounded-lg shadow p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Submit Application</h2>

            <form action="{{ route('student.scholarship.apply', $scholarship) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="essay" class="block text-sm font-medium text-gray-700 mb-2">
                        Personal Statement / Essay <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="essay"
                        name="essay"
                        rows="8"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="Tell us why you deserve this scholarship (minimum 100 characters)"
                    >{{ old('essay') }}</textarea>
                    <p class="text-sm text-gray-500 mt-2">Minimum 100 characters required</p>
                    @error('essay')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-4">
                    <button
                        type="submit"
                        class="bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-lg transition"
                    >
                        Submit Application
                    </button>
                    <a
                        href="{{ route('student.scholarships') }}"
                        class="text-gray-600 hover:text-gray-900"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    @else
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
            <p class="text-blue-900 font-semibold">You have already applied for this scholarship</p>
            <p class="text-blue-700 mt-2">Check your dashboard for application status</p>
        </div>
    @endif
</div>
@endsection
    