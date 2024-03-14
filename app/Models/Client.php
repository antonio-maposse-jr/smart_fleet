<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable=[
        'client_id',
        'user_id',
        'gender',
        'city',
        'state',
        'country',
        'zip_code',
        'address',
        'parent_id',
        'notes',

    ];
}
