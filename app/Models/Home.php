<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Home extends Model
{
    use HasFactory;
   
    
    
    
    public $timestamps = false;
    protected $table='homes';
    
    protected $fillable = [
        'banner',
        'title',
        'content',
        'description',
        'partner',
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];
   
}
