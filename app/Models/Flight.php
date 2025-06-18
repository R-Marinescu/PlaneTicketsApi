<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function flightOrigins() {
        return $this->belongsTo(FlightOrigin::class, 'origin_id');
    }

    public function flightDestinations() {
        return $this->belongsTo(FlightDestination::class, 'destination_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'flight_id');
    }

}
