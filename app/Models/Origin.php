<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{

    public function flights() {
        return $this->hasMany(Flight::class, 'origin_id');
    }
}
