<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public function origin() {
        return $this->belongsTo(Origin::class, 'origin_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'flight_id');
    }

}
