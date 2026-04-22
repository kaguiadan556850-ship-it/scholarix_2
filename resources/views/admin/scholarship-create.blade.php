@extends('layouts.admin')

@section('title', 'Create Scholarship - SCHOLARIX')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('admin.scholarships') }}" class="inline-flex items-center text-primary hover:underline">
        ← Back to Scholarships
    </a>

    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-3xl font-bold text-gray-900">Create New Scholarship</h1>
        <p class="text-gray-600 mt-2">Add a new scholarship program</p>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('admin.scholarship.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Scholarship Name <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="e.g., Academic Excellence Scholarship"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Describe the scholarship program"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount (₱) <span class="text-red-500">*</span></label>
                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        value="{{ old('amount') }}"
                        step="0.01"
                        min="0"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="10000.00"
                    >
                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Deadline <span class="text-red-500">*</span></label>
                    <input
                        type="date"
                        id="deadline"
                        name="deadline"
                        value="{{ old('deadline') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    >
                    @error('deadline')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slots" class="block text-sm font-medium text-gray-700 mb-2">Available Slots <span class="text-red-500">*</span></label>
                    <input
                        type="number"
                        id="slots"
                        name="slots"
                        value="{{ old('slots') }}"
                        min="1"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="10"
                    >
                    @error('slots')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        value="{{ old('category') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="e.g., Academic, Athletic, Need-based"
                    >
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                <textarea
                    id="requirements"
                    name="requirements"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="List the requirements (one per line)"
                >{{ old('requirements') }}</textarea>
                @error('requirements')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <select
                    id="status"
                    name="status"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                >
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
                <button
                    type="submit"
                    class="bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-lg transition"
                >
                    Create Scholarship
                </button>
                <a
                    href="{{ route('admin.scholarships') }}"
                    class="text-gray-600 hover:text-gray-900"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
