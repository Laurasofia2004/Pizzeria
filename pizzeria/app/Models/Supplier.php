<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_info',
    ];

    /**
     * Relación con el modelo Purchase.
     * Un proveedor puede tener muchas compras asociadas.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
