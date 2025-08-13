<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BlogSchema;
class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';



	    protected $fillable = [
        'title',
        'icon',
        'overview',
        'slug',
        'image',
        'body',
        'publish_at',
        'status',
        'html_title',
        'url_component',
        'meta_description',
        'meta_keywords',
    ];


    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $slug = Str::slug($model->title);

            $count = static::where('slug', $slug)->where('id', '!=', $model->id)->count();
            if ($count > 0) {
                $slug .= '-' . uniqid();
            }
            $model->slug = $slug;
        });
    }

    
}
