<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "image", "ingredients"
    ];

    protected $casts = [
        "ingredients"=> "array"
    ];

    public static function name($name){
        return self::where('name', $name);
    }
}
