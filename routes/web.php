<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', [StudentController::class, 'home'])->name('home');
Route::get('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
Route::post('/store-student', [StudentController::class, 'storeStudent'])->name('store-student');
Route::get('/all-students', [StudentController::class, 'allStudents'])->name('all.students');
Route::get('/edit-student/{id}', [StudentController::class, 'editStudent'])->name('edit-student');
Route::put('/update-student/{id}', [StudentController::class, 'updateStudent'])->name('update-student');
Route::delete('/delete-student/{id}', [StudentController::class, 'deleteStudent'])->name('delete-student');
Route::get('/search-student', [StudentController::class, 'searchStudent'])->name('search.student');
