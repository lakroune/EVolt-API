<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $fillable = [
        'user_id',
        'charging_station_id',
        'start_time',
        'estimated_duration_minutes',
        'status'
    ];

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
    public function isExpired()
    {
        return $this->end_time < now();
    }
}
