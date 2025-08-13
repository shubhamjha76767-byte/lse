<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seting extends Model
{
    protected $table = 'setings';

    protected $casts = [
        'explore' => 'array',
        'email_to' => 'array',
    ];

    protected $fillable = [
        'logo',
        'time',
        'email',
        'contact',
        'whatsapp',
        'telegram',
        'explore',
        'insta',
        'tweeter',
        'facebook',
        'email_to',
    ];
}
