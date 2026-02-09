<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'description'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
