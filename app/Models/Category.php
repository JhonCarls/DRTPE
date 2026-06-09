<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes; // 👈 ¡Añade SoftDeletes aquí!

    protected $fillable = ['pp_code', 'name', 'description', 'department'];
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}