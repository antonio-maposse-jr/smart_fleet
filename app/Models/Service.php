<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable=[
        'vehicle',
        'service_start_date',
        'service_end_date',
        'total_amount',
        'status',
        'notes',
        'files',
        'parent_id',
    ];

    public static $status=[
        'scheduled'=>'Scheduled',
        'in_progress'=>'In Progress',
        'completed'=>'Completed',
        'on_hold'=>'On Hold',
        'cancelled'=>'Cancelled',
    ];

    public function vehicles()
    {
        return $this->hasOne('App\Models\Vehicle','id','vehicle');
    }
}
