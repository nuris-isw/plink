<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_url',
        'slug',
        'clicks',
    ];

    /**
     * Mendapatkan user pemilik link ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper untuk mendapatkan URL pendek lengkap (opsional)
     * Contoh penggunaan: $link->full_short_url
     */
    public function getFullShortUrlAttribute(): string
    {
        return url('/' . $this->slug);
    }
}
