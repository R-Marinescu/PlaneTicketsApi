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

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment() {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}
