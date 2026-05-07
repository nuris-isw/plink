<?php

namespace App\Http\Controllers;

use App\Models\Link;

class LinkController extends Controller
{
    public function redirect($slug)
    {
        // Cari slug, jika tidak ada langsung 404
        $link = Link::where('slug', $slug)->firstOrFail();
        
        // Tambah jumlah klik
        $link->increment('clicks');

        // Alihkan ke URL asli
        return redirect()->away($link->original_url);
    }
}