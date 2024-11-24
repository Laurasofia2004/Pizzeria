<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order_pizza extends Model
{
    use HasFactory;
    protected $table = 'order_pizza';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function pizza_size()
    {
        return $this->belongsTo(Pizza_Size::class, 'pizza_size_id');
    }
}
