<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaIngredient extends Model
{
    use HasFactory;

    // Especificamos que la tabla 'pizza_ingredient' es la tabla pivot
    protected $table = 'pizza_ingredient';

    // Especificamos los campos que se pueden asignar masivamente
    protected $fillable = [
        'pizza_id',
        'ingredient_id',
    ];

    /**
     * Relación con el modelo Pizza.
     * Un ingrediente está asociado a una pizza.
     */
    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    /**
     * Relación con el modelo Ingredient.
     * Un ingrediente está asociado a una pizza.
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
