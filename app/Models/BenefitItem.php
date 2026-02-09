<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenefitItem extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'order', 'is_active'];
}
