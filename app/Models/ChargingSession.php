<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargingSession extends Model
{
    protected $table = 'charging_sessions';

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
