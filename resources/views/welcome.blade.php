@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[80vh] text-center px-4">
    <div class="mb-12">
        <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight">Student Management System</h1>
        <p class="text-lg text-gray-600 mt-4">Manage, View and Search Students Easily</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-3xl">
        <a href="{{ route('add.student') }}"
           class="flex flex-col items-center p-6 bg-teal-500 text-white font-semibold rounded-2xl shadow-xl hover:bg-teal-600 transition-transform transform hover:-translate-y-2">
           <span class="text-3xl mb-2">➕</span>
           <span class="text-lg">Add Student</span>
        </a>

        <a href="{{ route('all.students') }}"
           class="flex flex-col items-center p-6 bg-indigo-600 text-white font-semibold rounded-2xl shadow-xl hover:bg-indigo-700 transition-transform transform hover:-translate-y-2">
           <span class="text-3xl mb-2">📋</span>
           <span class="text-lg">All Students</span>
        </a>

        <a href="{{ route('search.student') }}"
           class="flex flex-col items-center p-6 bg-slate-600 text-white font-semibold rounded-2xl shadow-xl hover:bg-slate-700 transition-transform transform hover:-translate-y-2">
           <span class="text-3xl mb-2">🔍</span>
           <span class="text-lg">Search Student</span>
        </a>
    </div>
</div>
@endsection
