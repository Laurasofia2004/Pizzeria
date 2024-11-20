<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * Relación con el modelo Order.
     * Un ingrediente extra puede aparecer en muchos pedidos.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_extra_ingredient')->withPivot('quantity');
    }
}
