@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-8 text-center text-slate-800">All Students</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 text-center shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
    <button id="toggleView"
        class="px-5 py-2.5 flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-indigo-600
               text-white font-medium rounded-xl shadow-md hover:from-indigo-600 hover:to-indigo-700
               transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
        Toggle List/Grid
    </button>
</div>


    <div id="studentsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($students as $student)
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-200">
                <div class="flex items-center space-x-4 mb-4">
                    @if($student->photo)
                        <img src="{{ asset('storage/' . $student->photo) }}"
                             class="w-20 h-20 object-cover rounded-full border-2 border-indigo-200 shadow-sm">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-3xl text-gray-400 border border-gray-200">
                            👤
                        </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-xl text-slate-800">{{ $student->name }}</h3>
                        <p class="text-sm text-gray-500">Class {{ $student->class }} | Section {{ $student->section }}</p>
                    </div>
                </div>

                <div class="space-y-2 text-sm text-gray-700">
                    <p><span class="font-semibold">📅 DOB:</span> {{ $student->dob }}</p>
                    <p><span class="font-semibold">📞 Contact:</span> {{ $student->contact }}</p>
                    <p><span class="font-semibold">⚧ Gender:</span> {{ $student->gender }}</p>
                    <p><span class="font-semibold">🏫 School:</span> {{ $student->previous_school ?? '-' }}</p>
                    <p><span class="font-semibold">🧩 Disabilities:</span> {{ $student->disabilities ?? '-' }}</p>
                </div>

                <div class="flex justify-between mt-5">
    <a href="{{ route('edit-student', $student->id) }}"
       class="px-4 py-2 flex items-center gap-2 bg-yellow-400 text-white font-medium rounded-xl
              shadow-md hover:bg-yellow-500 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
        Edit
    </a>

    <form action="{{ route('delete-student', $student->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this student?');">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="px-4 py-2 flex items-center gap-2 bg-red-500 text-white font-medium rounded-xl
                   shadow-md hover:bg-red-600 transition-all duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg">
            Delete
        </button>
    </form>
</div>

            </div>
        @empty
            <p class="text-gray-500 text-center col-span-3">No students found.</p>
        @endforelse
    </div>
</div>

<script>
    document.getElementById('toggleView').addEventListener('click', () => {
        const container = document.getElementById('studentsContainer');
        container.classList.toggle('grid');
        container.classList.toggle('flex');
        container.classList.toggle('flex-col');
    });
</script>
@endsection
