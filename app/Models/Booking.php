<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'user_id',
        'flight_id',
        'status',
    ];

    public function flight() {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function passenger () {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payments() {
        return $this->belongsTo(Payment::class, 'booking_id');
    }
}
