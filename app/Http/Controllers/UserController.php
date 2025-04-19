<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'role' => ['required', 'string', 'in:manager,staff'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Get user data for editing
     */
    public function edit(User $user)
    {
        if ($user->isAdmin()) {
            return response()->json(['error' => 'Admin users cannot be edited.'], 403);
        }
        return response()->json($user);
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('users.index')
                ->with('error', 'Admin users cannot be edited.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => $request->filled('password') ? ['required', Password::defaults()] : ['nullable'],
            'role' => ['required', 'string', 'in:manager,staff'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete the specified user
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('users.index')
                ->with('error', 'Admin users cannot be deleted.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Suspend the specified user
     */
    public function suspend(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('users.index')
                ->with('error', 'Admin users cannot be suspended.');
        }

        $user->suspend();

        return redirect()->route('users.index')
            ->with('success', 'User suspended successfully.');
    }

    /**
     * Unsuspend the specified user
     */
    public function unsuspend(User $user)
    {
        $user->unsuspend();

        return redirect()->route('users.index')
            ->with('success', 'User unsuspended successfully.');
    }
}
