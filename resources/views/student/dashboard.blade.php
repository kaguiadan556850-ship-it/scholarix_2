@extends('layouts.student')

@section('title', 'Student Dashboard - SCHOLARIX')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold text-gray-900">Welcome {{ $user->name }}</h1>
        <p class="text-gray-600 mt-2">Student ID: {{ $user->student_id }} | {{ $user->course }}</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm font-medium">Total Applications</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_applications'] }}</div>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-6">
            <div class="text-blue-700 text-sm font-medium">Pending</div>
            <div class="text-3xl font-bold text-blue-900 mt-2">{{ $stats['pending'] }}</div>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-6">
            <div class="text-green-700 text-sm font-medium">Approved</div>
            <div class="text-3xl font-bold text-green-900 mt-2">{{ $stats['approved'] }}</div>
        </div>
        <div class="bg-red-50 rounded-lg shadow p-6">
            <div class="text-red-700 text-sm font-medium">Rejected</div>
            <div class="text-3xl font-bold text-red-900 mt-2">{{ $stats['rejected'] }}</div>
        </div>
    </div>

    <!-- Applications List -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">My Applications</h2>
        </div>
        <div class="p-6">
            @if($applications->count() > 0)
                <div class="space-y-4">
                    @foreach($applications as $application)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $application->scholarship->name }}</h3>
                                    <p class="text-gray-600 mt-1">₱{{ number_format($application->scholarship->amount, 2) }}</p>
                                    <p class="text-sm text-gray-500 mt-2">Submitted: {{ $application->submitted_at->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    @if($application->status === 'pending')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Pending</span>
                                    @elseif($application->status === 'approved')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Approved</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Rejected</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 mb-4">You haven't applied for any scholarships yet</p>
                    <a href="{{ route('student.scholarships') }}" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-lg transition">
                        Browse Scholarships
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
