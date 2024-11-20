<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaRawMaterial extends Model
{
    use HasFactory;

    // Especificamos que la tabla 'pizza_raw_material' es la tabla pivot
    protected $table = 'pizza_raw_material';

    // Especificamos los campos que se pueden asignar masivamente
    protected $fillable = [
        'pizza_id',
        'raw_material_id',
        'quantity',
    ];

    /**
     * Relación con el modelo Pizza.
     * Una pizza está asociada a una materia prima.
     */
    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    /**
     * Relación con el modelo RawMaterial.
     * Una materia prima está asociada a una pizza.
     */
    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
