<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
        'user_id',
        'customer_name',
        'total',
        'status',
        'payment_method',
        'order_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function products()
{
    return $this->belongsToMany(Product::class)
                ->withPivot(['quantity', 'price'])
                ->withTimestamps();
}

}

