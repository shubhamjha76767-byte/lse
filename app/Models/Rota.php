<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Rota extends Model
{
    use HasFactory;

    protected $fillable = [
        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday',
    ];

    protected $casts = [
        'monday'    => 'array',
        'tuesday'   => 'array',
        'wednesday' => 'array',
        'thursday'  => 'array',
        'friday'    => 'array',
        'saturday'  => 'array',
        'sunday'    => 'array',
    ];

    /**
     * Get all profiles for a specific day.
     *
     * @param string $day e.g. "monday"
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function profilesForDay(string $day)
    {
        $day = strtolower($day);
        $profileIds = $this->$day ?? [];

        return Profile::whereIn('id', $profileIds)->get();
    }

    /**
     * Return all day-wise profiles.
     *
     * @return array
     * Example:
     * [
     *   'monday' => [Profile, Profile],
     *   'tuesday' => [],
     *   ...
     * ]
     */
    public function allDayWiseProfiles()
    {
        $result = [];
        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
            $result[$day] = $this->profilesForDay($day);
        }

        return $result;
    }
}
