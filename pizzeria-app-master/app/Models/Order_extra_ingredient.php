<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order_extra_ingredient extends Model
{
    use HasFactory;
    protected $table = 'order_extra_ingredient';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function extra_ingredient()
    {
        return $this->belongsTo(ExtraIngredient::class, 'extra_ingredient_id');
    }
}
