<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .transition-transform {
            transition: transform 0.2s ease-in-out;
        }
        .hover:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-indigo-900 text-white px-8 py-4 flex justify-between items-center shadow-lg">
        <a href="{{ route('home') }}" class="flex items-center">
            <h1 class="font-bold text-xl">Student Management</h1>
        </a>
        <div class="space-x-6">
            <a href="{{ route('home') }}" class="hover:text-teal-400 transition-colors duration-300">Home</a>
            <a href="{{ route('add.student') }}" class="hover:text-teal-400 transition-colors duration-300">Add Student</a>
            <a href="{{ route('all.students') }}" class="hover:text-teal-400 transition-colors duration-300">All Students</a>
            <a href="{{ route('search.student') }}" class="hover:text-teal-400 transition-colors duration-300">Search</a>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    <footer class="fixed bottom-0 w-full text-center text-gray-500 text-xs py-4 bg-white/70 backdrop-blur-sm">
        &copy; {{ date('Y') }} Student Management System. Built with ❤️ in Laravel.
    </footer>
</body>
</html>
