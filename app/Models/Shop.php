<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "name", "address", "phone","user_id", "boss_phone", "type","bonus"
    ];

    public $appends = [
        'expeditor'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    protected function getExpeditorAttribute()
    {
        return $this->user->name;
    }
}
