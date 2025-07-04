<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintain extends Model
{

    protected $fillable = [
        'vehicleId',
        'customerId',
        'tMileage',
        'Note',
        'lastService',
        'lastBrake',
        'lastOil',
        'lastEngine',
        'lastTire',
        'predictedDate',
        'send',
        'sentCount',
        'sendby',
        'lastSentDate',
    ];
}
