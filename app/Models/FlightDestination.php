<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightDestination extends Model
{
    protected $fillable = [
        'airport',
        'country',
        'city',
    ];

    public function flights() {
        $this->hasMany(Flight::class, 'destination_id');
    }
}
