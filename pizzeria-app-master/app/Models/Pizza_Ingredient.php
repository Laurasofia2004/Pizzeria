<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pizza_Ingredient extends Model
{
    use HasFactory;
    protected $table = 'pizza_ingredient';
    
    public function pizza()
    {
        return $this->belongsTo(Pizza::class, 'pizza_id');
    }

    public function ingredient()
{
    return $this->belongsTo(Ingredient::class, 'ingredient_id');
}

}
