<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'subtitle', 'link', 'is_active'];

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
