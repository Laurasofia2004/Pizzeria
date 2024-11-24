<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtraIngredient extends Model
{
    use HasFactory;

    protected $table = 'extra_ingredients';

    protected $fillable = [
        'name',  
        'price', 
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_extra_ingredient', 'extra_ingredient_id', 'order_id')
                    ->withPivot('quantity') 
                    ->withTimestamps(); 
    }
}