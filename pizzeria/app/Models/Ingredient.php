<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relación con el modelo Pizza.
     * Un ingrediente puede aparecer en muchas pizzas.
     */
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_ingredient');
    }
}

