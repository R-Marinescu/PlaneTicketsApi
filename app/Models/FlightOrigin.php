<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightOrigin extends Model
{
    protected $fillable = [
        'airport',
        'country',
        'city',
    ];
    public function flights() {
        return $this->hasMany(Flight::class, 'origin_id');
    }
}
