<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargingStation extends Model
{
    protected $table = 'charging_stations';

    protected $fillable = [
        'name',
        'power_kw',
        'latitude',
        'longitude',
        'address',
        'status',
        'price_per_kwh',
        'connector_type_id',
    ];


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function connectorType()
    {
        return $this->belongsTo(ConnectorType::class);
    }
}
