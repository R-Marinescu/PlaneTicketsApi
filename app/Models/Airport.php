<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = [
        'name',
        'iata_code',
        'country',
        'city',
    ];

    public function departures() {
        $this->hasMany(Flight::class, 'destination_id');
    }

    public function arrivals() {
        $this->hasMany(Flight::class, 'destination_id');
    }
}
