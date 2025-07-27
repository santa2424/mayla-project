<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 protected $fillable = [
    'name',
    'category_id',
    'price',
    'discount',
    'image',
    'user_id',
];


    public function category()
{
    return $this->belongsTo(Category::class);
}
    public function user()
{
    return $this->belongsTo(User::class);
}

public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function rate()
{
    return $this->ratings->isNotEmpty() ? $this->ratings->sum('value') / $this->ratings->count() : 0 ;
}
        public function getDiscountedPrice()
        {
            return $this->price - ($this->price * $this->discount / 100);
        }

}
