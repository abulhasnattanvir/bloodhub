<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'member_id',
        'amount',
        'months_covered',
        'month',
        'method',
        'note',
        'paid_at'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function donor()
    {
        return $this->hasOne(Donor::class);
    }
}