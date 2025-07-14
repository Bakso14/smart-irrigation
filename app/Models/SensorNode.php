<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorNode extends Model
{
    protected $fillable = [
        'node',
        'tegangan',
        'arus',
        'sensor1',
        'sensor2',
        'sensor3',
    ];
}
