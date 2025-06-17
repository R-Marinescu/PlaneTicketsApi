<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{

    public function bookings() {
        return $this->hasMany(Booking::class, 'booking_id');
    }
}
