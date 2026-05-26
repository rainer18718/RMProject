<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return match ($request->session()->get('user_role')) {
            'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            default => redirect()->route('student.dashboard'),
        };
    }

    public function admin()
    {
        return view('dashboards.admin', [
            'studentCount' => Student::count(),
            'teacherCount' => UserAccount::where('role', 'teacher')->count(),
        ]);
    }

    public function teacher()
    {
        return view('dashboards.teacher');
    }

    public function student(Request $request)
    {
        $student = Student::with('degree')
            ->where('user_account_id', $request->session()->get('user_account_id'))
            ->first();

        return view('dashboards.student', compact('student'));
    }
}
