<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LinkController extends Controller
{
    public function redirect($slug)
    {
        $link = \App\Models\Link::where('slug', $slug)->firstOrFail();
        $link->increment('clicks');
        return redirect()->away($link->original_url);
    }
}
