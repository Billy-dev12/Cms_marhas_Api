<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['title', 'type', 'content', 'extras'];

    protected $casts = [
        'extras' => 'array',
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
