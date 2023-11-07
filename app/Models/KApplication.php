<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'k_data',
        'status'
    ];

    protected $casts = [
        'k_data' => 'array',
    ];
}
