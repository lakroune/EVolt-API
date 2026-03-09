<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectorType extends Model
{
    protected $table = 'connector_types';

    protected $fillable = [
        'name',
        'description',
    ];

    public function chargingStations()
    {
        return $this->hasMany(ChargingStation::class);
    }
}
