<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function index()
    {
        $degrees = Degree::latest()->paginate(5);
        return view('degrees.index', compact('degrees'));
    }

    public function create()
    {
        return view('degrees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'degree_title' => 'required|string|max:255',
        ]);

        Degree::create([
            'degree_title' => $request->degree_title,
        ]);

        return redirect('degrees')->with('success', 'Degree added successfully.');
    }

    public function show(Degree $degree)
    {
        return view('degrees.show', compact('degree'));
    }

    public function edit(Degree $degree)
    {
        return view('degrees.edit', compact('degree'));
    }

    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'degree_title' => 'required|string|max:255',
        ]);

        $degree->update([
            'degree_title' => $request->degree_title,
        ]);

        return redirect('degrees')->with('success', 'Degree updated successfully.');
    }

    public function destroy(Degree $degree)
    {
        $degree->delete();

        return redirect('degrees')->with('success', 'Degree deleted successfully.');
    }
}
