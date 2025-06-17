<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{

    public function flights() {
        $this->hasMany(Flight::class, 'destination_id');
    }
}
