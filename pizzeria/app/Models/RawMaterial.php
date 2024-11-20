<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'current_stock',
    ];

    /**
     * Relación con el modelo Pizza.
     * Una materia prima puede estar asociada a muchas pizzas.
     */
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_raw_material');
    }

    /**
     * Relación con el modelo Purchase.
     * Una materia prima puede estar asociada a muchas compras.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
