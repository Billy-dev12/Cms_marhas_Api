<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// App\Models\Media.php
class Media extends Model
{
    protected $fillable = ['file_path', 'mediable_id', 'mediable_type'];
    protected $appends = ['url'];

    public function mediable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}