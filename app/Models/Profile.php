<?php



namespace App\Models;



use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;



class Profile extends Model

{

    use HasFactory;



    protected $table = 'profiles';



 protected $fillable = [

        'thumbnail',

        'name',

        'email',

        'slug',

        'hair',

        'eyes',

        'nationality',

        'main_location',

        'bust',

        'dress',

        'orientation',

        'languages',

        'tags',

        'description',

        'whatsapp',

        'telegram',

        'starting_rate',

        'incall_half_hour',

        'incall_1_hour',

        'incall_2_hour',

        'incall_3_hour',

        'incall_3_hour_dinner_date',

        'incall_overnight_9h',

        'incall_overnight_12h',

        'outcall_half_hour',

        'outcall_1_hour',

        'outcall_2_hour',

        'outcall_3_hour',

        'outcall_3_hour_dinner_date',

        'outcall_overnight_9h',

        'outcall_overnight_12h',

        'gallery_images',

        'gallery_videos',

        'education',

        'status',

        'monday','tuesday','wednesday','thursday','friday','saturday','sunday','desable','age','height','order_by','meta_keyword','meta_discription','meta_title',

    ];



    protected $casts = [

        'languages' => 'array',

        'tags' => 'array',

        'gallery_images' => 'array',

        'gallery_videos' => 'array',

        'starting_rate' => 'decimal:2',

        'status' => 'boolean',

         'monday' => 'array',

    'tuesday' => 'array',

    'wednesday' => 'array',

    'thursday' => 'array',

    'friday' => 'array',

    'saturday' => 'array',

    'sunday' => 'array',

    ];



    /**

     * The locations that belong to the profile.

     */

    public function locations()

    {

        return $this->belongsToMany(Location::class, 'location_profile');

    }



    /**

     * The categories that belong to the profile.

     */

    public function categories()

    {

        return $this->belongsToMany(Category::class, 'category_profile');

    }

// app/Models/Profile.php

public function bookings()
{
    return $this->hasMany(Bookingdata::class);
}




    protected static function boot()

    {

        parent::boot();



        static::creating(function ($riCategory) {

            if (empty($riCategory->slug)) {

                $riCategory->slug = Str::slug($riCategory->name);

            }

        });



        static::updating(function ($riCategory) {

            if (empty($riCategory->slug)) {

                $riCategory->slug = Str::slug($riCategory->name);

            }

        });

    }



    public function relatedProfiles()

{

    return $this->belongsToMany(

        Profile::class,

        'duo_profile',

        'profile_id',

        'related_profile_id'

    );

}



protected static function booted()

{

    static::saved(function ($profile) {

        if (request()->has('relatedProfiles')) {

            $selectedIds = request('relatedProfiles');

            

            // Save for this profile

            $profile->relatedProfiles()->sync($selectedIds);



            // Also attach reverse relations

            foreach ($selectedIds as $relatedId) {

                $related = self::find($relatedId);

                if ($related) {

                    $related->relatedProfiles()->syncWithoutDetaching([$profile->id]);

                }

            }



            // Optional: remove reverse relations no longer selected

            $existingReverse = \DB::table('duo_profile')

                ->where('related_profile_id', $profile->id)

                ->pluck('profile_id')

                ->toArray();



            $toDetach = array_diff($existingReverse, $selectedIds);

            if (!empty($toDetach)) {

                \DB::table('duo_profile')

                    ->where('related_profile_id', $profile->id)

                    ->whereIn('profile_id', $toDetach)

                    ->delete();

            }

        }

    });

}


public function getAvatarUrlAttribute()
{
    return $this->avatar ?: '/default.png';
}





}