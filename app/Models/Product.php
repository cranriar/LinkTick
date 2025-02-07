<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'description',
        'discount',
        'name',
        'price',
        'sku',
        'status',
        'stock',
    ];
}
