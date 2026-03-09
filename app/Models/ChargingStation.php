<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargingStation extends Model
{
    protected $table = 'charging_stations';



    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    
}
