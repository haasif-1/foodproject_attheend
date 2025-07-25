<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\product;
class order extends Model
{
    //
    protected $fillable = [
    'user_id',
    'user_name',
    'email',
    'phone',
    'country',
    'province',
    'city',
    'street',
    'product_ids',
    'amount',
    'status ',
    'cancelled_at',
];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
 


}
