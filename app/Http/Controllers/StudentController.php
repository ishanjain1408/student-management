<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

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
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }

        Student::create([
            'name' => $request->input('name'),
            'dob' => $request->input('dob'),
            'contact' => $request->input('contact'),
            'gender' => $request->input('gender'),
            'class' => $request->input('class'),
            'section' => $request->input('section'),
            'previous_school' => $request->input('previous_school'),
            'disabilities' => implode(', ', $request->input('disabilities', [])),
            'photo' => $photoPath,
        ]);

        return redirect()->route('all.students')->with('success', 'Student added successfully!');
    }

    public function allStudents()
    {
        $students = Student::all();
        return view('all-students', ['students' => $students]);
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
