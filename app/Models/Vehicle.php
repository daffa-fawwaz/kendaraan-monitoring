<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'license_plate',
        'ownership',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
