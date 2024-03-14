<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable=[
        'vehicle_id',
        'type',
        'name',
        'model',
        'engine_type',
        'engine_no',
        'registration_expiry_date',
        'license_plate',
        'document',
        'color',
        'notes',
        'parent_id',
    ];

    public function types()
    {
        return $this->hasOne('App\Models\VehicleType','id','type');
    }
}

