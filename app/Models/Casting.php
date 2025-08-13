<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casting extends Model
{
    // Optional: specify table name if not plural ('abouts' is default for 'About')
    // protected $table = 'abouts';

    protected $fillable = [
        // Our Story Details
        
        'description',
          
        // SEO Meta
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    // If using timestamps, leave this; otherwise, set to false
   
}
