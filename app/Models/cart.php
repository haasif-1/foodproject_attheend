<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'quantity',
    ];
    
}
