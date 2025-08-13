<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Profile;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
 

class RotaController extends Controller
{
   
   


public function weekrota()
{
        $dayNames = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    $today = Carbon::now();
    $todayIndex = $today->dayOfWeek; // 0 (Sunday) to 6 (Saturday)

    // Reorder days starting from today
    $orderedDays = array_merge(array_slice($dayNames, $todayIndex), array_slice($dayNames, 0, $todayIndex));

    $rotaData = DB::table('rotas')->first();
    $weekRota = [];

    foreach ($orderedDays as $offset => $dayKey) {
        $dateObj = $today->copy()->addDays($offset);
        $dateNumber = $dateObj->format('d');
        $dayLabel = ucfirst(substr($dayKey, 0, 3));
        $fullDate = $dateObj->format('d F, y');

        $profileIds = json_decode($rotaData->$dayKey ?? '[]', true);
        $profiles = Profile::whereIn('id', $profileIds)->where('desable',1)->get();

        $entries = [];

        foreach ($profiles as $profile) {
            $entries[] = [
                'id' => $profile->id,
                'name' => $profile->name,
               'available' => $profile->status == 1,
                'times' => ['12:00pm-17:00pm', '19:00pm-22:00pm'],
                'fullDate' => $fullDate,
                'collapseId' => "collapse{$dayLabel}{$dateNumber}Rota",
            ];
        }

        $weekRota[] = [
            'day' => $dayLabel,
            'date' => $dateNumber,
            'entries' => $entries
        ];
    }


   $startDate = $today->copy();
$endDate = $today->copy()->addDays(6);

// If same month
if ($startDate->format('F') === $endDate->format('F')) {
    $weekRange = $startDate->format('j') . '–' . $endDate->format('j') . ' ' . $startDate->format('F');
} else {
    // Different months
    $weekRange = $startDate->format('j F') . '–' . $endDate->format('j F');
}


    //dd($weekRota);

    return view('rota', compact('weekRota', 'weekRange'));
}


public function dailyRota()
{
    $today = Carbon::now();
    $dayKey = strtolower($today->format('l')); // e.g., 'monday'
    $dayLabel = ucfirst(substr($dayKey, 0, 3)); // e.g., 'Mon'
    $dateNumber = $today->format('d');
    $fullDate = $today->format('d F, y');

    $rotaData = DB::table('rotas')->first();
    $profileIds = json_decode($rotaData->$dayKey ?? '[]', true);

    $profiles = Profile::whereIn('id', $profileIds)->where('desable',1)->get();

    $entries = [];

    foreach ($profiles as $profile) {
        $entries[] = [
            'id' => $profile->id,
            'name' => $profile->name,
            'available' => $profile->status == 1,
            'times' => ['12:00pm-17:00pm', '19:00pm-22:00pm'],
            'fullDate' => $fullDate,
            'collapseId' => "collapse{$dayLabel}{$dateNumber}Rota",
        ];
    }

    $todayRota = [
        'day' => $dayLabel,
        'date' => $dateNumber,
        'entries' => $entries
    ];

    $today = Carbon::now();
    $startOfWeek = $today->copy()->startOfWeek(Carbon::MONDAY);
    $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

    $weekRange = $today->format('j F');

   
         return view('rotaday', [
        'todayRota' => $todayRota,
        'weekRange' => $weekRange,
        'today' => $today,
    ]);

   
}



}