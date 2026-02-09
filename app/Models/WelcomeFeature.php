<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeFeature extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'type', 'order', 'is_active'];
}
