<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
 protected $fillable = ['name', 'price', 'image'];

    protected $table = 'products';

    public function users()
    {
        return $this->belongsToMany(User::class,'product_user');
    }
}
