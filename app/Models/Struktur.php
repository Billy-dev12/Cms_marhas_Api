<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya sesuai di database k

    /**
     * RELASI INI YANG HILANG:
     * Menghubungkan Sambutan ke tabel Media
     */
    public function media()
    {
        // 'mediable' adalah nama prefix morph kamu (biasanya mediable_id, mediable_type)
        // Sesuaikan nama 'mediable' dengan yang ada di migrasi tabel media kamu
        return $this->morphMany(Media::class, 'mediable');
    }
}