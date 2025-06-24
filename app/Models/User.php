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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($roleName) {
        return $this->roles()->where('role_name', $roleName)->exists();
    }

    public function assignRoleByName($roleName) {
        $role = Role::where('role_name', $roleName)->firstOrFail();

        $this->roles()->syncWithoutDetaching($role->id);
    }
}
