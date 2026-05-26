<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = UserAccount::where('role', 'teacher')->latest()->paginate(5);

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
}
