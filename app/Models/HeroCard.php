<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroCard extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'link', 'order'];

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
