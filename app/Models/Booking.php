<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=[
        'booking_id',
        'client',
        'vehicle',
        'driver',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'pickup_address',
        'drop_off_address',
        'total_traveller',
        'approx_distance',
        'status',
        'amount',
        'payment_status',
        'payment_notes',
        'parent_id',
        'notes',
    ];

    public static $status=[
        'yet_to_start'=>'Yet to Start',
        'completed'=>'Completed',
        'on_going'=>'On Going',
        'cancelled'=>'Cancelled',
    ];

    public static $paymentStatus=[
        'paid'=>'Paid',
        'unpaid'=>'Unpaid',
        'partial_paid'=>'Partial Paid',
    ];

    public function clients()
    {
        return $this->hasOne('App\Models\User','id','client');
    }
    public function drivers()
    {
        return $this->hasOne('App\Models\User','id','driver');
    }
    public function vehicles()
    {
        return $this->hasOne('App\Models\Vehicle','id','vehicle');
    }
}
