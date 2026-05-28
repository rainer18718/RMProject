<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Degree;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $degrees = Degree::all();
        $students = Student::with(['degree', 'userAccount'])->latest()->get();

        return view('students.index', compact('degrees', 'students'));
    }

    public function ajaxIndex()
    {
        $students = Student::with(['degree', 'userAccount'])->latest()->get();

        return response()->json([
            'students' => $students,
        ]);
    }

    public function create()
    {
        $degrees = Degree::all();
        return view('students.create', compact('degrees'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'student_id' => 'required|string|max:255',
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'contact_number' => 'required|string|max:255',
        //     'email' => 'required|email|unique:students,email',
        //     'degree_id' => 'required|exists:degrees,id',
        // ]);

        $request->validate([
            // 'student_id' => 'required',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'address' => 'required',
            'contact_number' => 'required|digits:11',
            'email' => 'required|email|unique:students,email|unique:user_accounts,email',
            'degree_id' => 'required|exists:degrees,id',
            'username' => 'nullable|unique:user_accounts,username',
            'password' => 'nullable|min:8',
        ]);

        DB::transaction(function () use ($request) {
            $username = $request->filled('username')
                ? $request->input('username')
                : $this->uniqueUsername($request);
            $password = $request->filled('password') ? $request->input('password') : 'student123';

            $user = UserAccount::create([
                'username' => $username,
                'email' => $request->input('email'),
                'password' => Hash::make($password),
                'role' => 'student',
                'is_active' => 1,
            ]);

            Student::create([
                'user_account_id' => $user->id,
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'degree_id' => $request->degree_id,
            ]);
        });

        $msg = "Student is Added!";
        Log::info($msg);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student added successfully.',
            ], 201);
        }

        return redirect('students')->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('degree');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $degrees = Degree::all();
        return view('students.edit', compact('student', 'degrees'));
    }

    public function update(Request $request, Student $student)
    {
        // $request->validate([
        //     'student_id' => 'required|string|max:255',
        //     'first_name' => 'required|string|max:255',
        //     'last_name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'contact_number' => 'required|integer',
        //     'email' => 'required|email|unique:students,email,' . $student->id,
        //     'degree_id' => 'required|exists:degrees,id',
        // ]);
        $request->validate([
            // 'student_id' => 'required',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'address' => 'required',
            'contact_number' => 'required|digits:11',
            'email' => [
                'required',
                'email',
                'unique:students,email,' . $student->id,
                'unique:user_accounts,email,' . $student->user_account_id,
            ],
            'degree_id' => 'required|exists:degrees,id',
        ]);

        DB::transaction(function () use ($request, $student) {
            $student->update([
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'degree_id' => $request->degree_id,
            ]);

            if ($student->userAccount) {
                $student->userAccount->update([
                    'email' => $request->email,
                ]);
            }
        });
        
        $msg = "Student is Updated!";
        Log::info($msg);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Student updated successfully.',
            ]);
        }

        return redirect('students')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $userAccount = $student->userAccount;
            $student->delete();

            if ($userAccount && $userAccount->role === 'student') {
                $userAccount->delete();
            }
        });

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Student deleted successfully.',
            ]);
        }

        return redirect('students')->with('success', 'Student deleted successfully.');
    }

    private function uniqueUsername(Request $request): string
    {
        $base = Str::slug(
            $request->input('student_id')
                ?: Str::before($request->input('email'), '@')
                ?: $request->input('first_name') . ' ' . $request->input('last_name'),
            '.'
        );

        $base = $base !== '' ? $base : 'student';
        $username = $base;
        $count = 1;

        while (UserAccount::where('username', $username)->exists()) {
            $username = $base . '.' . $count;
            $count++;
        }

        return $username;
    }
}
