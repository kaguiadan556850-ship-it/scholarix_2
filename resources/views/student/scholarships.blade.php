@extends('layouts.student')

@section('title', 'Browse Scholarships - SCHOLARIX')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold text-gray-900">Available Scholarships</h1>
        <p class="text-gray-600 mt-2">Browse and apply for scholarships that match your profile</p>
    </div>

    <!-- Scholarships List -->
    @if($scholarships->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($scholarships as $scholarship)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $scholarship->name }}</h3>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Amount:</span>
                                <span class="font-semibold text-primary">₱{{ number_format($scholarship->amount, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Deadline:</span>
                                <span class="font-semibold">{{ $scholarship->deadline->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Available Slots:</span>
                                <span class="font-semibold">{{ $scholarship->slots - $scholarship->slots_filled }}</span>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $scholarship->description }}</p>

                        @if(in_array($scholarship->id, $appliedScholarshipIds))
                            <button disabled class="w-full bg-gray-300 text-gray-600 font-semibold py-2 rounded-lg cursor-not-allowed">
                                Already Applied
                            </button>
                        @else
                            <a href="{{ route('student.scholarship.show', $scholarship) }}" class="block w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 rounded-lg text-center transition">
                                View Details & Apply
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500 text-lg">No scholarships available at the moment</p>
            <p class="text-gray-400 mt-2">Check back later for new opportunities</p>
        </div>
    @endif
</div>
@endsection
