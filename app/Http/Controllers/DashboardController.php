<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan daftar link.
     */
    public function index(): View
    {
        $query = Link::with('user');

        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }

        $links = $query->latest()->get();

        return view('dashboard', compact('links'));
    }

    public function storeLink(Request $request)
    {
        // Daftar kata yang tidak boleh digunakan sebagai slug
        $reservedWords = ['dashboard', 'users', 'profile', 'login', 'logout', 'auth', 'register'];

        $request->validate([
            'original_url' => ['required', 'url', 'max:2048'],
            'slug' => [
                'required', 
                'alpha_dash', 
                'min:3', 
                'max:50', 
                Rule::unique('links', 'slug'),
                // Tambahkan validasi ini:
                Rule::notIn($reservedWords),
            ],
        ]);

        Link::create([
            'user_id'      => auth()->id(),
            'original_url' => $request->original_url,
            'slug'         => Str::lower($request->slug),
        ]);

        return back()->with('status', 'Link berhasil dibuat!');
    }

    public function destroyLink(Link $link)
    {
        if (!auth()->user()->is_admin && $link->user_id !== auth()->id()) {
            abort(403);
        }

        $link->delete();
        return back()->with('status', 'Link berhasil dihapus.');
    }
}
