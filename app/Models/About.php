<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    // Optional: specify table name if not plural ('abouts' is default for 'About')
    // protected $table = 'abouts';

    protected $fillable = [
        // Our Story Details
        'title',
        'sub_image_1',
        'sub_content_1',
        'sub_image_2',
        'sub_content_2',

        // Our Model
        'modeltitle',
        'model_image',
        'description',

        // SEO Meta
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    // If using timestamps, leave this; otherwise, set to false
   
}
