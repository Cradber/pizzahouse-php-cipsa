<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIngredients extends Model
{
    use HasFactory;

    protected $table = 'order_ingredients';
    protected $fillable = ['order_id', 'ingredient_id'];
}
