<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargingSession extends Model
{
    protected $table = 'charging_sessions';

    protected $fillable = [
        'reservation_id',
        'start_time',
        'end_time',
        'energy_delivered_kwh',
        'total_cost'
    ];
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
