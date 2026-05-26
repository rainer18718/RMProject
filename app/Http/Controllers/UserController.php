<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('loginPage')->with('msg', session('msg', ''));
        }

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        try {
            $user = UserAccount::where('username', $credentials['username'])->first();
        } catch (QueryException $e) {
            return back()
                ->withInput($request->except('password'))
                ->with('msg', 'Database connection failed. Please start MySQL or check your database settings.');
        }

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if (! $user->is_active) {
                return back()
                    ->withInput($request->except('password'))
                    ->with('msg', 'Your account is inactive.');
            }

            $request->session()->regenerate();
            $request->session()->put('user_account_id', $user->id);
            $request->session()->put('user_role', $user->role);

            return redirect()->route('dashboard');
        }

        return back()
            ->withInput($request->except('password'))
            ->with('msg', 'Wrong credentials.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_account_id', 'user_role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('msg', 'You have been logged out.');
    }
}
