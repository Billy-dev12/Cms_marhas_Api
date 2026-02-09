<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Kejuruan extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'visi_misi',
        'ikon',
        'extras',
    ];

    protected $casts = [
        'extras' => 'array',
    ];

    protected $appends = ['ikon_url'];

    public function getIkonUrlAttribute()
    {
        return $this->ikon ? asset('storage/' . $this->ikon) : null;
    }

    // Gunakan ini untuk foto utama (satu foto)
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}