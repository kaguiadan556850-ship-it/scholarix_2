@extends('layouts.admin')

@section('title', 'Admin Dashboard - SCHOLARIX')

@section('content')
<div class="space-y-6">
    <!-- Welcome Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Manage your scholarship system</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm font-medium">Total Students</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_students'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm font-medium">Total Scholarships</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_scholarships'] }}</div>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-6">
            <div class="text-green-700 text-sm font-medium">Active Scholarships</div>
            <div class="text-3xl font-bold text-green-900 mt-2">{{ $stats['active_scholarships'] }}</div>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-6">
            <div class="text-blue-700 text-sm font-medium">Pending Applications</div>
            <div class="text-3xl font-bold text-blue-900 mt-2">{{ $stats['pending_applications'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm font-medium">Total Applications</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_applications'] }}</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.scholarship.create') }}" class="bg-primary hover:bg-primary-dark text-white rounded-lg shadow p-6 transition text-center">
            <div class="text-xl font-bold">+ Create Scholarship</div>
            <p class="text-sm mt-2 text-blue-100">Add a new scholarship program</p>
        </a>
        <a href="{{ route('admin.students') }}" class="bg-white hover:shadow-lg rounded-lg shadow p-6 transition text-center">
            <div class="text-xl font-bold text-gray-900">View Students</div>
            <p class="text-sm mt-2 text-gray-600">Manage student records</p>
        </a>
        <a href="{{ route('admin.applications') }}" class="bg-white hover:shadow-lg rounded-lg shadow p-6 transition text-center">
            <div class="text-xl font-bold text-gray-900">Review Applications</div>
            <p class="text-sm mt-2 text-gray-600">Process pending applications</p>
        </a>
    </div>

    <!-- Recent Applications -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Recent Applications</h2>
        </div>
        <div class="p-6">
            @if($recentApplications->count() > 0)
                <div class="space-y-4">
                    @foreach($recentApplications as $application)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $application->user->name }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $application->scholarship->name }}</p>
                                    <p class="text-sm text-gray-500 mt-2">Submitted: {{ $application->submitted_at->format('M d, Y h:i A') }}</p>
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
                                        Review →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500">No applications yet</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
