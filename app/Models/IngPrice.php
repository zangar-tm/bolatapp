<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id','price'
    ];
}
