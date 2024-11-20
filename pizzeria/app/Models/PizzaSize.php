<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'pizza_id',
        'size',
        'price',
    ];

    /**
     * Relación con el modelo Pizza.
     * Un tamaño de pizza pertenece a una pizza.
     */
    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    /**
     * Relación con el modelo Order.
     * Un tamaño de pizza puede aparecer en muchos pedidos.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_pizza')->withPivot('quantity');
    }
}
