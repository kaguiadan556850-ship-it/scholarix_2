<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scholarix - @yield('title', 'Scholarship Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1d4ed8',
                            dark: '#1e40af',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .text-primary { color: #1d4ed8; }
        .bg-primary { background-color: #1d4ed8; }
        .bg-primary-dark { background-color: #1e40af; }
        .hover\:bg-primary-dark:hover { background-color: #1e40af; }
        .focus\:ring-primary:focus { --tw-ring-color: #1d4ed8; }
        .border-primary { border-color: #1d4ed8; }
        .text-primary-dark { color: #1e40af; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    @auth
    <nav class="bg-primary shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold tracking-wide text-white">?? Scholarix</a>
            <div class="flex items-center gap-6">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-white hover:underline">Dashboard</a>
                    <a href="{{ route('admin.scholarships') }}" class="text-white hover:underline">Scholarships</a>
                    <a href="{{ route('admin.applications') }}" class="text-white hover:underline">Applications</a>
                    <a href="{{ route('admin.students') }}" class="text-white hover:underline">Students</a>
                @else
                    <a href="{{ route('student.dashboard') }}" class="text-white hover:underline">Dashboard</a>
                    <a href="{{ route('student.scholarships') }}" class="text-white hover:underline">Scholarships</a>
                    <a href="{{ route('student.profile') }}" class="text-white hover:underline">Profile</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-white text-primary px-3 py-1 rounded hover:bg-gray-100 font-semibold">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <main class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
