<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'discount',
        'sub_total',
        'tax',
        'total',
        'status',
    ];
}
