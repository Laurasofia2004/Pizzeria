<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    
    public function raw_material()
    {
        return $this->belongsTo(Raw_material::class, 'raw_material_id');
    }
}
