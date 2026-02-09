<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya sesuai di database kamu
    protected $table = 'sambutans';

    protected $fillable = [
        'nama_kepala_sekolah',
        'isi_sambutan',
        // tambahkan kolom lain yang ada di tabel sambutan kamu
    ];

    /**
     * RELASI INI YANG HILANG:
     * Menghubungkan Sambutan ke tabel Media
     */
    // app/Models/Sambutan.php
    public function media()
    {
        // 'mediable' adalah nama prefix morph kamu (biasanya mediable_id, mediable_type)
        // Sesuaikan nama 'mediable' dengan yang ada di migrasi tabel media kamu
        return $this->morphMany(Media::class, 'mediable');
    }
}