<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
    ];

    /**
     * Relación con el modelo Order.
     * Un cliente puede tener muchos pedidos.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
