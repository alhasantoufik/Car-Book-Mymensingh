<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'owner_id',
        'car_brand_id',
        'car_category_id',
        'title',
        'model',
        'year',
        'registration_number',
        'price_per_day',
        'seats',
        'fuel_type',
        'description',
        'status',
        'is_available',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function category()
    {
        return $this->belongsTo(CarCategory::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
