<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_number',
        'origin_id',
        'destination_id',
    ];

    public function flightOrigins() {
        return $this->belongsTo(Airport::class, 'origin_id');
    }

    public function flightDestinations() {
        return $this->belongsTo(Airport::class, 'destination_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'flight_id');
    }

}
