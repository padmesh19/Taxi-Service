<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'pickup',
        'pickupLat',
        'pickupLong',
        'destination',
        'destinationLat',
        'destinationLong',
        'pickTime',
        'distance',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function ratings()
    {
        return $this->hasOne(Payment::class);
    }

    public function CompletedRides()
    {
        return $this->hasOne(CompletedRide::class);
    }
    
}
