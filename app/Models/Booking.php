<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    public function flight() {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function passenger () {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }

    public function payments() {
        return $this->belongsTo(Payment::class, 'booking_id');
    }
}
