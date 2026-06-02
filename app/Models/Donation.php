<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'amount',
        'method',
        'transaction_id',
        'status',
    ];
}