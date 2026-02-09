<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialWidget extends Model
{
    use HasFactory;

    protected $fillable = ['platform', 'embed_code', 'url', 'is_active', 'order'];
}
