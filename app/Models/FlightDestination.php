<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightDestination extends Model
{

    public function flights() {
        $this->hasMany(Flight::class, 'destination_id');
    }
}
