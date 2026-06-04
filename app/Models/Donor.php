<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donor extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'full_name',
        'profile_photo',
        'blood_group_id',
        'phone_number',
        'gender',
        'address',
        'last_donation_date',
        'availability_status',
        'email',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'last_donation_date' => 'date',
    ];

    /**
     * Get the blood group that owns the donor.
     */
    public function bloodGroup(): BelongsTo
    {
        return $this->belongsTo(BloodGroup::class);
    }

}