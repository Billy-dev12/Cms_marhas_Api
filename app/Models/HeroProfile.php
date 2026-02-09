<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroProfile extends Model
{
    protected $fillable = ['title', 'is_active'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getImageUrlAttribute()
    {
        return $this->media->first()?->url ?? null;
    }
}
