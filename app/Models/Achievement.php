<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['title', 'winner_name', 'rank', 'level', 'date_achieved', 'description'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
