<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remain extends Model
{
    use HasFactory;

    protected $fillable = ['ingredient_id', 'operation','number'];
}
