<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relación con el modelo PizzaSize.
     * Una pizza puede tener varios tamaños.
     */
    public function sizes()
    {
        return $this->hasMany(PizzaSize::class);
    }

    /**
     * Relación con el modelo Ingredient.
     * Una pizza puede tener muchos ingredientes.
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'pizza_ingredient');
    }

    /**
     * Relación con el modelo RawMaterial.
     * Una pizza puede tener muchos materiales raw.
     */
    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class, 'pizza_raw_material');
    }
}

