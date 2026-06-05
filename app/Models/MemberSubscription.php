<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberSubscription extends Model
{
    protected $fillable = [
        'member_id',
        'month',
        'expected_amount',
        'status',
        'paid_at'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}