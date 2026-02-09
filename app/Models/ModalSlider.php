<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalSlider extends Model
{
    protected $fillable = ['title', 'is_active', 'order'];

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
