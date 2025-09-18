@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
    <h2 class="text-3xl font-bold text-slate-800 mb-6 text-center">Add Student</h2>

     @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store-student') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" placeholder="Enter full name" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
            <input type="date" name="dob" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
            <input type="text" name="contact" placeholder="Enter contact number" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-700 mb-2">Gender</span>
            <div class="flex gap-6">
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Male" required>
                    Male
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Female">
                    Female
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Other">
                    Other
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
            <select name="class" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                <option value="" disabled selected>Select Class</option>
                @for($i=1; $i<=12; $i++)
                    <option value="{{ $i }}">Class {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
            <select name="section" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                <option value="" disabled selected>Select Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Previous School</label>
            <input type="text" name="previous_school" placeholder="Enter previous school" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-700 mb-2">Learning Disabilities</span>
            <div class="grid grid-cols-2 gap-3">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="Dyslexia">
                    Dyslexia
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="ADHD">
                    ADHD
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="Hearing Impairment">
                    Hearing Impairment
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="Other">
                    Other
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Student Photo</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-600">
        </div>

        <button type="submit" class="w-full bg-teal-500 text-white py-3 rounded-lg shadow-md hover:bg-teal-600 transition">
            Save Student
        </button>
    </form>
</div>
@endsection
