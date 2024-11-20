<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPizza extends Model
{
    use HasFactory;

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'order_id',
        'pizza_size_id',
        'quantity',
    ];

    /**
     * Relación con el modelo Order.
     * Un registro de OrderPizza pertenece a un pedido.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relación con el modelo PizzaSize.
     * Un registro de OrderPizza pertenece a un tamaño de pizza.
     */
    public function pizzaSize()
    {
        return $this->belongsTo(PizzaSize::class);
    }
}
