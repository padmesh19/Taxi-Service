<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public function RideRequests()
    {
        return $this->belongsTo(RideRequest::class);
    }

    public function users()
    {
        return $this->belongsTo(RideRequest::class);
    }
}
