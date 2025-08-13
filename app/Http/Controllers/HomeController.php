<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Home;
use App\Models\Profile;
use App\Models\Blog;
use Illuminate\Http\Request;
use DB;
 use App\Models\Location;
 use App\Models\Category;
use App\Models\Duopage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Favirout;

class HomeController extends Controller
{
  public function index(Request $request)
{
    $home = Home::first();
    $query = Profile::query();

$hasCustomSort = false;

// 👇 Decrypt 'q' and extract filters
if ($request->has('q')) {
    try {
        $decrypted = base64_decode($request->get('q'));
        parse_str($decrypted, $filters); // e.g., "sort=name_asc&availability=1"

        // Apply sorting
        switch ($filters['sort'] ?? null) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                $hasCustomSort = true;
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                $hasCustomSort = true;
                break;
            case 'price_low_high':
                $query->orderBy('starting_rate', 'asc');
                $hasCustomSort = true;
                break;
            case 'price_high_low':
                $query->orderBy('starting_rate', 'desc');
                $hasCustomSort = true;
                break;
        }

        // Apply availability filter
        if (isset($filters['availability'])) {
            $query->where('status', $filters['availability']);
        }
    } catch (\Exception $e) {
        // Log error or ignore invalid filter
    }
}

// Apply default sort by order_by if no custom sort is applied
if (!$hasCustomSort) {

    $query->orderBy('order_by', 'asc');

    
}


// Final filter: only enabled profiles
$profiles = $query->where('desable', 1)->get();


    $blogs = Blog::where('status', 1)
             ->orderBy('publish_at', 'desc')
             ->take(3)
             ->get();


    return view('index', [
        'data' => $home,
        'profiles' => $profiles,
         'blogs' => $blogs,
        
    ]);
}



public function toggleFavourite(Request $request)
{
    $id = (int) $request->id;
    $key = 'favourites_' . $request->ip(); // or session()->getId()
    $favourites = Cache::get($key, []);

    if (in_array($id, $favourites)) {
        $favourites = array_diff($favourites, [$id]);
        $status = 'removed';
    } else {
        $favourites[] = $id;
        $status = 'added';
    }

    Cache::put($key, $favourites, now()->addHours(24));

    return response()->json(['status' => $status]);
}

public function duoProfile(Request $request)
{
  $query = DB::table('duo_profile')
    ->selectRaw('LEAST(profile_id, related_profile_id) as profile_a, GREATEST(profile_id, related_profile_id) as profile_b')
    ->distinct();

// Decode and parse filters
$filters = [];
if (request()->has('q')) {
    parse_str(base64_decode(request('q')), $filters);
}

// Fetch raw duo pairs
$duos = $query->get();

// Load and filter `$a` profiles
$duoProfiles = $duos->map(function ($duo) {
    return [
        'a' => \App\Models\Profile::find($duo->profile_a),
        'b' => \App\Models\Profile::find($duo->profile_b),
    ];
})->filter(function ($duo) use ($filters) {
    $a = $duo['a'];

    // Availability filter
    if (isset($filters['availability']) && $a->status != $filters['availability']) {
        return false;
    }

    return true;
});

// Sort
if (isset($filters['sort'])) {
    $sort = $filters['sort'];
    $duoProfiles = match ($sort) {
        'name_asc' => $duoProfiles->sortBy(fn ($duo) => $duo['a']->name),
        'name_desc' => $duoProfiles->sortByDesc(fn ($duo) => $duo['a']->name),
        'price_low_high' => $duoProfiles->sortBy(fn ($duo) => $duo['a']->starting_rate),
        'price_high_low' => $duoProfiles->sortByDesc(fn ($duo) => $duo['a']->starting_rate),
        default => $duoProfiles,
    };
}

$duoProfiles = $duoProfiles->values(); // reindex

$content = Duopage::first();

return view('duogallery', [
    'duoProfiles' => $duoProfiles,
    'data' => $content,
]);

}



public function toggleDuoFavourite(Request $request)
{
    $duoKey = $request->duo_key; // e.g., "12-34"
    $key = 'favourites_duo_' . $request->ip();
    $favourites = Cache::get($key, []);

    if (in_array($duoKey, $favourites)) {
        $favourites = array_diff($favourites, [$duoKey]);
        $status = 'removed';
    } else {
        $favourites[] = $duoKey;
        $status = 'added';
    }

    Cache::put($key, $favourites, now()->addHours(24));

    return response()->json(['status' => $status]);
}




public function showFavourites()
{
    $ip = request()->ip();

    $singleKey = 'favourites_' . $ip;
    $duoKey = 'favourites_duo_' . $ip;

    $singleIds = Cache::get($singleKey, []);
    $duoKeys = Cache::get($duoKey, []);

    // Fetch single profiles
    $singleProfiles = Profile::whereIn('id', $singleIds)->get();

    // Fetch duo profiles using your pivot table (e.g., 'duo_profile')
   $duoProfilePairs = [];

foreach (Cache::get('favourites_duo_' . request()->ip(), []) as $duoKey) {
    [$id1, $id2] = explode('-', $duoKey);

    $p1 = Profile::find($id1);
    $p2 = Profile::find($id2);

    if ($p1 && $p2) {
        $duoProfilePairs[] = [$p1, $p2]; // 👈 must be an array of pairs
    }
}


  $data =Favirout::first();



return view('favourite-gallery', [
    'singleProfiles' => $singleProfiles,
    'duoProfiles' => $duoProfilePairs,
    'data' => $data,
]);
}



public function locationdtails(Request $request,$slug)
{
    // Get the location by slug (404 if not found)
    $location = Location::where('slug', $slug)->firstOrFail();

    // Get profiles that belong to this location
     $query = Profile::where('desable',1)->with('locations')
        ->whereHas('locations', function ($q) use ($location) {
            $q->where('locations.id', $location->id);
        });

    // 👇 Decrypt 'q' and apply filters
    if ($request->has('q')) {
        try {
            $decrypted = base64_decode($request->get('q'));
            parse_str($decrypted, $filters); // "sort=abc&availability=1" => ['sort' => ..., 'availability' => ...]

            // Sorting
            switch ($filters['sort'] ?? null) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_low_high':
                    $query->orderBy('starting_rate', 'asc');
                    break;
                case 'price_high_low':
                    $query->orderBy('starting_rate', 'desc');
                    break;
            }

            // Availability
            if (isset($filters['availability'])) {
                $query->where('status', $filters['availability']);
            }
        } catch (\Exception $e) {
            // fail silently or log error
        }
    }

    // Final result
    $data = $query->get();
    return view('locationdetails', compact('data', 'location'));
}

public function categorydtails(Request $request,$slug)
{
    // Get the location by slug (404 if not found)
    $category = Category::where('slug', $slug)->firstOrFail();

    // Get profiles that belong to this location
     $query = Profile::where('desable',1)->with('categories')
        ->whereHas('categories', function ($q) use ($category) {
            $q->where('categories.id', $category->id);
        });

    // 👇 Decrypt 'q' and apply filters
    if ($request->has('q')) {
        try {
            $decrypted = base64_decode($request->get('q'));
            parse_str($decrypted, $filters); // "sort=abc&availability=1" => ['sort' => ..., 'availability' => ...]

            // Sorting
            switch ($filters['sort'] ?? null) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_low_high':
                    $query->orderBy('starting_rate', 'asc');
                    break;
                case 'price_high_low':
                    $query->orderBy('starting_rate', 'desc');
                    break;
            }

            // Availability
            if (isset($filters['availability'])) {
                $query->where('status', $filters['availability']);
            }
        } catch (\Exception $e) {
            // fail silently or log error
        }
    }

    // Final result
    $data = $query->get();
    return view('categorydetailspage', compact('data', 'category'));
}




public function profiledetails(Request $request, $slug)
{
    $profile = Profile::where('desable', 1)->where('slug', $slug)->with(['categories','locations'])->firstOrFail();

    $today = Carbon::now();
    $rotaData = DB::table('rotas')->first(); // assuming one row with weekly data

    $sevenDayRota = [];

    for ($i = 0; $i < 7; $i++) {
        $date = $today->copy()->addDays($i);
        $dayName = strtolower($date->format('l')); // e.g. 'monday'
        $dayShort = ucfirst($date->format('D'));   // e.g. 'Mon'
        $dayNum = $date->format('d');
        $fullDate = $date->format('j F, Y');

        $profileIds = json_decode($rotaData->$dayName ?? '[]', true);
        $isAvailable = in_array($profile->id, $profileIds);
        
        $sevenDayRota[] = [
            'day' => $dayShort,
            'date' => $dayNum,
            'fullDate' => $fullDate,
            'available' => $isAvailable,
            'collapseId' => "collapse{$dayShort}{$dayNum}Rota",
        ];
    }

   // dd($profile,$sevenDayRota);

    return view('profiledetails', compact('profile', 'sevenDayRota'));
}


}
