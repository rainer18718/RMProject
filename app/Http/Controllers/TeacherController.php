<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = UserAccount::where('role', 'teacher')->latest()->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:user_accounts,username',
            'email' => 'required|email|unique:user_accounts,email',
            'password' => 'required|min:8',
        ]);

        UserAccount::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
            'is_active' => 1,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher account added successfully.');
    }

    public function show(UserAccount $teacher)
    {
        $this->ensureTeacher($teacher);

        return view('teachers.show', compact('teacher'));
    }

    public function edit(UserAccount $teacher)
    {
        $this->ensureTeacher($teacher);

        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, UserAccount $teacher)
    {
        $this->ensureTeacher($teacher);

        $validated = $request->validate([
            'username' => 'required|string|unique:user_accounts,username,' . $teacher->id,
            'email' => 'required|email|unique:user_accounts,email,' . $teacher->id,
            'password' => 'nullable|min:8',
            'is_active' => 'nullable|boolean',
        ]);

        $teacher->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $request->filled('password') ? Hash::make($validated['password']) : $teacher->password,
            'role' => 'teacher',
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher account updated successfully.');
    }

    public function destroy(UserAccount $teacher)
    {
        $this->ensureTeacher($teacher);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher account deleted successfully.');
    }

    private function ensureTeacher(UserAccount $teacher): void
    {
        abort_unless($teacher->role === 'teacher', 404);
    }
}
