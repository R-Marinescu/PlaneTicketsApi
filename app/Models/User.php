<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];
    public function bookings() {
        return $this->hasMany(Booking::class, 'booking_id');
    }
}
