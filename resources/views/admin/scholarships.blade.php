@extends('layouts.admin')

@section('title', 'Manage Scholarships - SCHOLARIX')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow p-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Scholarships</h1>
            <p class="text-gray-600 mt-2">Manage scholarship programs</p>
        </div>
        <a href="{{ route('admin.scholarship.create') }}" class="bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-lg transition">
            + Create Scholarship
        </a>
    </div>

    <!-- Scholarships Grid -->
    @if($scholarships->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($scholarships as $scholarship)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $scholarship->name }}</h3>
                            @if($scholarship->status === 'active')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Active</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">Inactive</span>
                            @endif
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Amount:</span>
                                <span class="font-semibold text-primary">₱{{ number_format($scholarship->amount, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Deadline:</span>
                                <span class="font-semibold text-sm">{{ $scholarship->deadline->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Slots:</span>
                                <span class="font-semibold text-sm">{{ $scholarship->slots_filled }}/{{ $scholarship->slots }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Applications:</span>
                                <span class="font-semibold text-sm">{{ $scholarship->applications_count }}</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 pt-4 border-t border-gray-200">
                            <a href="{{ route('admin.scholarship.edit', $scholarship) }}" class="flex-1 text-center bg-primary hover:bg-primary-dark text-white font-medium py-2 rounded-lg transition text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.scholarship.delete', $scholarship) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this scholarship?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 font-medium rounded-lg transition text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">No scholarships created yet</p>
            <a href="{{ route('admin.scholarship.create') }}" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 rounded-lg transition">
                Create Your First Scholarship
            </a>
        </div>
    @endif
</div>
@endsection
