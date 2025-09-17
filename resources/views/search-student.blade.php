@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h2 class="text-3xl font-bold text-slate-800 mb-8 text-center">🔍 Search Student</h2>

    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-10">
        <form action="{{ route('search.student') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Student Name</label>
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Enter Student Name"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Class</label>
                <select name="class"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="">Select Class</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('class') == $i ? 'selected' : '' }}>Class {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Section</label>
                <select name="section"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="">Select Section</option>
                    <option value="A" {{ request('section') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ request('section') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ request('section') == 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Gender</label>
                <select name="gender"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">School</label>
                <input type="text" name="school" value="{{ request('school') }}" placeholder="Enter School Name"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ request('dob') }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div class="md:col-span-2">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-1">
                    🔎 Search Students
                </button>
            </div>
        </form>
    </div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @if(request()->anyFilled(['name','class','section','gender','school','dob']))
        @if(isset($students))
            @forelse($students as $student)
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl border border-gray-100 transition">
                    <div class="flex items-start gap-4">
                        @if($student->photo)
                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo"
                                class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500 flex-shrink-0">
                        @else
                            <div class="w-20 h-20 rounded-full bg-indigo-50 flex items-center justify-center text-2xl text-indigo-500 border border-gray-200">
                                👤
                            </div>
                        @endif
                        <div>
                            <h3 class="font-bold text-xl text-slate-800">{{ $student->name }}</h3>
                            <p class="text-sm text-gray-500">Class {{ $student->class }} | Section {{ $student->section ?? '-' }}</p>
                            <p class="text-xs text-gray-400">DOB: {{ $student->dob }}</p>
                        </div>
                    </div>
                    <div class="mt-4 text-sm text-gray-700 space-y-1">
                        <p><strong>📞 Contact:</strong> {{ $student->contact ?? '-' }}</p>
                        <p><strong>⚧ Gender:</strong> {{ $student->gender ?? '-' }}</p>
                        <p><strong>🏫 School:</strong> {{ $student->previous_school ?? '-' }}</p>
                        <p><strong>🧩 Disabilities:</strong> {{ $student->disabilities ?? '-' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center col-span-2 py-10">No results found for your search criteria.</p>
            @endforelse
        @endif
    @endif
</div>

</div>
@endsection
