@extends('layouts.admin')

@section('title', $student->name . ' - SCHOLARIX')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <a href="{{ route('admin.students') }}" class="inline-flex items-center text-primary hover:underline">
        ← Back to Students
    </a>

    <!-- Student Information -->
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $student->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <span class="text-gray-600 text-sm">Email:</span>
                <p class="font-medium text-gray-900">{{ $student->email }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Student ID:</span>
                <p class="font-medium text-gray-900">{{ $student->student_id }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Course:</span>
                <p class="font-medium text-gray-900">{{ $student->course }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Phone:</span>
                <p class="font-medium text-gray-900">{{ $student->phone ?? 'N/A' }}</p>
            </div>
            @if($student->gpa)
            <div>
                <span class="text-gray-600 text-sm">GPA:</span>
                <p class="font-medium text-gray-900">{{ number_format($student->gpa, 2) }}</p>
            </div>
            @endif
            <div>
                <span class="text-gray-600 text-sm">Registered:</span>
                <p class="font-medium text-gray-900">{{ $student->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        @if($student->address)
        <div class="mt-6">
            <span class="text-gray-600 text-sm">Address:</span>
            <p class="font-medium text-gray-900">{{ $student->address }}</p>
        </div>
        @endif
    </div>

    <!-- Applications -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Applications ({{ $applications->count() }})</h2>
        </div>
        <div class="p-6">
            @if($applications->count() > 0)
                <div class="space-y-4">
                    @foreach($applications as $application)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $application->scholarship->name }}</h3>
                                    <p class="text-gray-600 mt-1">₱{{ number_format($application->scholarship->amount, 2) }}</p>
                                    <p class="text-sm text-gray-500 mt-2">Submitted: {{ $application->submitted_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    @if($application->status === 'pending')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Pending</span>
                                    @elseif($application->status === 'approved')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Approved</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Rejected</span>
                                    @endif
                                    <a href="{{ route('admin.application.show', $application) }}" class="text-primary hover:underline text-sm font-medium">
                                        View →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500">No applications submitted yet</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
