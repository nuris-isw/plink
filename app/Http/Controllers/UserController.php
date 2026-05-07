<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')],
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            // Password tidak wajib karena login via Socialite
        ]);

        return redirect()->route('users.index')->with('status', 'User berhasil didaftarkan.');
    }

    public function update(Request $request, User $user)
    {
        // Mencegah admin menghapus status admin-nya sendiri secara tidak sengaja
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa mengubah role Anda sendiri.']);
        }

        $user->update(['is_admin' => !$user->is_admin]);
        return back()->with('status', 'Role user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri.']);
        }

        $user->delete();
        return back()->with('status', 'User berhasil dihapus.');
    }
}
