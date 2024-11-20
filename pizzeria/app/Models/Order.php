<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'branch_id',
        'total_price',
        'status',
        'delivery_type',
        'delivery_person_id',
    ];

    /**
     * Relación con el modelo Client.
     * Un pedido pertenece a un cliente.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relación con el modelo Branch.
     * Un pedido pertenece a una sucursal.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Relación con el modelo Employee.
     * Un pedido puede tener un empleado asignado como repartidor.
     */
    public function deliveryPerson()
    {
        return $this->belongsTo(Employee::class, 'delivery_person_id');
    }

    /**
     * Relación con el modelo Pizza.
     * Un pedido puede tener muchas pizzas.
     */
    public function pizzas()
    {
        return $this->belongsToMany(PizzaSize::class, 'order_pizza')->withPivot('quantity');
    }

    /**
     * Relación con el modelo ExtraIngredient.
     * Un pedido puede tener muchos ingredientes extra.
     */
    public function extraIngredients()
    {
        return $this->belongsToMany(ExtraIngredient::class, 'order_extra_ingredient')->withPivot('quantity');
    }
}
