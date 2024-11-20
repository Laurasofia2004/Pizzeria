<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Relación con el modelo Order.
     * Una sucursal puede tener muchos pedidos.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

