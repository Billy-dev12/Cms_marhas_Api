<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $fillable = ['name', 'website_url'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
