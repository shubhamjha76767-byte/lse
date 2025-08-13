<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookingdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'booking_date',
        'booking_time',
        'duration',
        'address',
        'notes',
        'full_name',
        'contact_number',
        'contact_email',
    ];

    /**
     * Get the profile associated with this booking.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
