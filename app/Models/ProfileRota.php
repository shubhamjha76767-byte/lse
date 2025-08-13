<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRota extends Model
{
    protected $table = 'profile_rotas';

    protected $fillable = [
        'profile_id', 'monday', 'tuesday', 'wednesday',
        'thursday', 'friday', 'saturday', 'sunday'
    ];

    protected $casts = [
        'monday' => 'array',
        'tuesday' => 'array',
        'wednesday' => 'array',
        'thursday' => 'array',
        'friday' => 'array',
        'saturday' => 'array',
        'sunday' => 'array',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    

}
