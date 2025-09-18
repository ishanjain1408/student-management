<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function addStudent()
    {
        return view('add-student');
    }

     public function storeStudent(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'dob' => [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                if (\Carbon\Carbon::parse($value)->age < 3) {
                    $fail('Student must be at least 3 years old.');
                }
            },
        ],
        'contact' => 'required|string|max:15',
        'gender' => 'required',
        'class' => 'required',
        'section' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $photoPath = $request->file('photo')->store('students', 'public');

    Student::create([
        'name' => $request->name,
        'dob' => $request->dob,
        'contact' => $request->contact,
        'gender' => $request->gender,
        'class' => $request->class,
        'section' => $request->section,
        'previous_school' => $request->previous_school,
        'disabilities' => $request->has('disabilities') ? implode(', ', $request->disabilities) : null,
        'photo' => $photoPath,
    ]);

    return redirect()->route('all.students')->with('success', 'Student added successfully!');
}


    public function allStudents()
    {
        $students = Student::all();
        return view('all-students', compact('students'));
    }

    public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('edit-student', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->age < 3) {
                        $fail('Student must be at least 3 years old.');
                    }
                },
            ],
            'contact' => 'required|string|max:15',
            'gender' => 'required',
            'class' => 'required',
            'section' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
            $student->photo = $photoPath;
        }

        $student->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'contact' => $request->contact,
            'gender' => $request->gender,
            'class' => $request->class,
            'section' => $request->section,
            'previous_school' => $request->previous_school,
            'disabilities' => $request->disabilities ? implode(', ', $request->disabilities) : null,
        ]);

        return redirect()->route('all.students')->with('success', 'Student updated successfully!');
    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('all.students')->with('success', 'Student deleted successfully!');
    }

    public function searchStudent(Request $request)
    {
        $query = Student::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('class')) {
            $query->where('class', $request->input('class'));
        }
        if ($request->filled('section')) {
            $query->where('section', $request->input('section'));
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->filled('school')) {
            $query->where('previous_school', 'like', '%' . $request->input('school') . '%');
        }
        if ($request->filled('dob')) {
            $query->where('dob', $request->input('dob'));
        }

        $students = $query->get();

        return view('search-student', ['students' => $students]);
    }

    public function search(Request $request)
{
    $query = Student::query();

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('class')) {
        $query->where('class', $request->class);
    }

    if ($request->filled('section')) {
        $query->where('section', $request->section);
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('school')) {
        $query->where('previous_school', 'like', '%' . $request->school . '%');
    }

    if ($request->filled('dob')) {
        $query->where('dob', $request->dob);
    }

    $students = $query->get();

    return view('search-student', compact('students'));
}

}
