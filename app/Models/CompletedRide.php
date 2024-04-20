<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedRide extends Model
{
    use HasFactory;

    public function RideRequests()
    {
        return $this->belongsTo(CompletedRide::class);
    }
}
