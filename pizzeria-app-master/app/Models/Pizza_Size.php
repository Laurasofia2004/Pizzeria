<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pizza_Size extends Model
{
    use HasFactory;
    protected $table = 'pizza_size';

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
