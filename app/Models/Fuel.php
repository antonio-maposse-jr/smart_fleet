<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;
    protected $fillable=[
        'vehicle',
        'driver',
        'date',
        'time',
        'quantity',
        'fuel_location',
        'meter_reading',
        'receipt',
        'notes',
        'parent_id',
    ];

    public function vehicles()
    {
        return $this->hasOne('App\Models\Vehicle','id','vehicle');
    }

    public function drivers()
    {
        return $this->hasOne('App\Models\User','id','driver');
    }
}
