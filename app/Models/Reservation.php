<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chargingStation()
    {
        return $this->belongsTo(ChargingStation::class);
    }
    public function chargingSessions()
    {
        return $this->hasOne(ChargingSession::class);
    }
}
