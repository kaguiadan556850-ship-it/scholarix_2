@extends('layouts.admin')

@section('title', 'Review Application - SCHOLARIX')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('admin.applications') }}" class="inline-flex items-center text-primary hover:underline">
        ← Back to Applications
    </a>

    <!-- Application Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Application Review</h1>
                <p class="text-gray-600 mt-2">Submitted {{ $application->submitted_at->format('M d, Y h:i A') }}</p>
            </div>
            @if($application->status === 'pending')
                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-medium">Pending Review</span>
            @elseif($application->status === 'approved')
                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full font-medium">Approved</span>
            @else
                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full font-medium">Rejected</span>
            @endif
        </div>
    </div>

    <!-- Student Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Student Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <span class="text-gray-600 text-sm">Name:</span>
                <p class="font-medium text-gray-900">{{ $application->user->name }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Student ID:</span>
                <p class="font-medium text-gray-900">{{ $application->user->student_id }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Email:</span>
                <p class="font-medium text-gray-900">{{ $application->user->email }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Course:</span>
                <p class="font-medium text-gray-900">{{ $application->user->course }}</p>
            </div>
            @if($application->user->gpa)
            <div>
                <span class="text-gray-600 text-sm">GPA:</span>
                <p class="font-medium text-gray-900">{{ number_format($application->user->gpa, 2) }}</p>
            </div>
            @endif
            @if($application->user->phone)
            <div>
                <span class="text-gray-600 text-sm">Phone:</span>
                <p class="font-medium text-gray-900">{{ $application->user->phone }}</p>
            </div>
            @endif
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.student.show', $application->user) }}" class="text-primary hover:underline text-sm font-medium">
                View Full Student Profile →
            </a>
        </div>
    </div>

    <!-- Scholarship Information -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Scholarship Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <span class="text-gray-600 text-sm">Name:</span>
                <p class="font-medium text-gray-900">{{ $application->scholarship->name }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Amount:</span>
                <p class="font-medium text-primary text-lg">₱{{ number_format($application->scholarship->amount, 2) }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Deadline:</span>
                <p class="font-medium text-gray-900">{{ $application->scholarship->deadline->format('M d, Y') }}</p>
            </div>
            <div>
                <span class="text-gray-600 text-sm">Available Slots:</span>
                <p class="font-medium text-gray-900">{{ $application->scholarship->slots - $application->scholarship->slots_filled }} / {{ $application->scholarship->slots }}</p>
            </div>
        </div>
    </div>

    <!-- Application Essay -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Personal Statement / Essay</h2>
        <div class="bg-gray-50 rounded-lg p-6">
            <p class="text-gray-900 whitespace-pre-line">{{ $application->essay }}</p>
        </div>
    </div>

    <!-- Admin Notes (if reviewed) -->
    @if($application->admin_notes)
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Admin Notes</h2>
        <div class="bg-gray-50 rounded-lg p-6">
            <p class="text-gray-900 whitespace-pre-line">{{ $application->admin_notes }}</p>
        </div>
        @if($application->reviewed_at)
        <p class="text-sm text-gray-500 mt-2">Reviewed on {{ $application->reviewed_at->format('M d, Y h:i A') }}</p>
        @endif
    </div>
    @endif

    <!-- Review Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Update Application Status</h2>
        <form action="{{ route('admin.application.update', $application) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Decision <span class="text-red-500">*</span></label>
                <select
                    id="status"
                    name="status"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                >
                    <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approve</option>
                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Reject</option>
                </select>
            </div>

            <div>
                <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                <textarea
                    id="admin_notes"
                    name="admin_notes"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Add notes about this decision (optional)"
                >{{ old('admin_notes', $application->admin_notes) }}</textarea>
                <p class="text-sm text-gray-500 mt-2">These notes are for internal use only</p>
            </div>

            <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                <button
                    type="submit"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-lg transition"
                >
                    Update Status
                </button>
                <a
                    href="{{ route('admin.applications') }}"
                    class="text-gray-600 hover:text-gray-900"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
