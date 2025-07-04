<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'vehicleId',
        'totalMilage',
        'lastService',
        'lServiceDate',
        'lastBrake',
        'lBrakeDate',
        'lastOil',
        'lOilDate',
        'lastEngine',
        'lEngineDate',
        'lastTire',
        'lTireDate',
        'isActive',
    ];

}
