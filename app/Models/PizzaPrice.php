<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaPrice extends Model
{
    use HasFactory;

    protected $table = 'pizza_price';
    protected $fillable = ['price', 'pizza_id', 'size_id'];

}
