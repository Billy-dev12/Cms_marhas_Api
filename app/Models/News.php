<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'status', 'event_date', 'location'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
