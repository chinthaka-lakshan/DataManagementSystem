<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
            'is_active' => 'required|boolean',
        ]);

        // Prevent admin from deactivating themselves or changing their own role to user
        if ($user->id === auth()->id()) {
            if ($request->is_active == false || $request->role !== 'admin') {
                return redirect()->back()->with('error', 'You cannot deactivate yourself or remove your admin privileges.');
            }
        }

        $user->update([
            'role' => $request->role,
            'is_active' => $request->is_active,
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself');
        }
        
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
