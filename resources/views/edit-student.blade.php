@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
    <h2 class="text-3xl font-bold text-slate-800 mb-6 text-center">Edit Student</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update-student', $student->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
            <input type="date" name="dob" value="{{ old('dob', $student->dob) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
            <input type="text" name="contact" value="{{ old('contact', $student->contact) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-700 mb-2">Gender</span>
            <div class="flex gap-6">
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Male" {{ $student->gender == 'Male' ? 'checked' : '' }}> Male
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Female" {{ $student->gender == 'Female' ? 'checked' : '' }}> Female
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" name="gender" value="Other" {{ $student->gender == 'Other' ? 'checked' : '' }}> Other
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
            <select name="class" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                <option value="" disabled>Select Class</option>
                @for($i=1; $i<=12; $i++)
                    <option value="{{ $i }}" {{ $student->class == $i ? 'selected' : '' }}>Class {{ $i }}</option>
                @endfor
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
            <select name="section" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                <option value="" disabled>Select Section</option>
                <option value="A" {{ $student->section == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ $student->section == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ $student->section == 'C' ? 'selected' : '' }}>C</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Previous School</label>
            <input type="text" name="previous_school" value="{{ old('previous_school', $student->previous_school) }}"
                   class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-700 mb-2">Learning Disabilities</span>
            <div class="grid grid-cols-2 gap-3">
                @php
                    $disabilities = explode(', ', $student->disabilities ?? '');
                @endphp
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="Dyslexia" {{ in_array('Dyslexia', $disabilities) ? 'checked' : '' }}> Dyslexia
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="ADHD" {{ in_array('ADHD', $disabilities) ? 'checked' : '' }}> ADHD
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="Hearing Impairment" {{ in_array('Hearing Impairment', $disabilities) ? 'checked' : '' }}> Hearing Impairment
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="disabilities[]" value="Other" {{ in_array('Other', $disabilities) ? 'checked' : '' }}> Other
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Student Photo</label>
            @if($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo"
                     class="w-24 h-24 object-cover rounded-full border mb-3">
            @endif
            <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-600">
            <p class="text-xs text-gray-500 mt-1">Leave empty to keep current photo.</p>
        </div>

        <button type="submit" class="w-full bg-indigo-500 text-white py-3 rounded-lg shadow-md hover:bg-indigo-600 transition">
            Update Student
        </button>
    </form>
</div>
@endsection
