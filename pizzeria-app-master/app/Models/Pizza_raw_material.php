<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pizza_raw_material extends Model
{
    use HasFactory;
    protected $table = 'pizza_raw_material';

    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id');
    }

    public function raw_material()
    {
        return $this->belongsTo(Raw_material::class, 'raw_material_id');
    }
}
