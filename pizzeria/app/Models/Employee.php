<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'position',
        'identification_number',
        'salary',
        'hire_date',
    ];

    /**
     * Relación con el modelo Order.
     * Un empleado puede estar asignado a muchos pedidos.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'delivery_person_id');
    }
}

