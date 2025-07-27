<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;
class User extends Authenticatable
{
    use HasApiTokens;
     use Billable;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
      // public function products()
//{
 //   return $this->hasMany(Product::class);
//}

public function products()
{
    return $this->belongsToMany(Product::class)
                ->withPivot('quantity', 'bought', 'price')
                ->withTimestamps();
}


public function ratings()
{
    return $this->hasMany(Rating::class);
}

public function rated(Product $product)
{
    return $this->ratings->where('product_id',$product->id)->isNotEmpty();
}

public function productRating(Product $product)
{
   return $this->rated($product) ? $this->ratings->where('product_id',$product->id)->first() : NULL;
}

public function productsInCart()
{
    return $this->belongsToMany(Product::class)
                ->withPivot('quantity', 'bought', 'price', 'created_at')
                ->withTimestamps();
}


public function cartItems()
{
    return $this->belongsToMany(\App\Models\Product::class, 'product_user')
                ->withPivot(['quantity', 'price', 'bought'])
                ->wherePivot('bought', false)
                ->withTimestamps();
}
public function cartProductCount()
{
    return $this->productsInCart()->sum('product_user.quantity');
}

public function orders()
{
    return $this->hasMany(Order::class);
}

}
