<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\About;
use App\Models\Term;
use App\Models\Privecy;

use App\Models\Profile;
use App\Models\Booking;
use App\Models\Casting;
use App\Models\Bookingdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Mail\BookingSubmitted;
use App\Mail\ApplicationMail;
use App\Models\Seting;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
 


public function about()
{
    $data = About::first();
    
        
    return view('aboutus', compact('data'));
}

 public function privecy()
 {
    $data = Privecy::first();

    return view('privecy', compact('data'));
 }

 public function term()
 {
    $data = Term::first();

    return view('term', compact('data'));
 }

 public function booking(Request $request)
 {
    $data = Booking::first();


    $selectedProfileId = null;

    if ($request->has('profile')) {
        try {
            $selectedProfileId = Crypt::decryptString($request->get('profile'));
        } catch (\Exception $e) {
            // Invalid or tampered encrypted string
            $selectedProfileId = null;
        }
    }

     $profiles = Profile::where('desable', 1)->get();
     

    return view('booking', compact('data','profiles','selectedProfileId'));
 }

 public function csting()
 {
    $data = Casting::first();

    return view('joinus', compact('data'));
 }


 public function submit(Request $request)
{
    // Save booking data
    $booking = new Bookingdata();

    $booking->profile_id      = $request->profile_id;
    $booking->booking_date    = $request->booking_date;
    $booking->booking_time    = $request->booking_time;
    $booking->duration        = $request->duration;
    $booking->address         = $request->address;
    $booking->notes           = $request->notes;
    $booking->full_name       = $request->full_name;
    $booking->contact_number  = $request->contact_number;
    $booking->contact_email   = $request->contact_email;

    $booking->save();

    // Fetch escort name (optional, for email)
    $profile = Profile::find($booking->profile_id);
    $data = [
        'escort_name'     => $profile->name ?? 'N/A',
        'booking_date'    => $booking->booking_date,
        'booking_time'    => $booking->booking_time,
        'duration'        => $booking->duration,
        'address'         => $booking->address,
        'notes'           => $booking->notes,
        'full_name'       => $booking->full_name,
        'contact_number'  => $booking->contact_number,
        'contact_email'   => $booking->contact_email,
    ];

    // Send email to admin

    $emailData = Seting::first();

      $toEmails = [];

if (!empty($emailData->email_to) && is_array($emailData->email_to)) {
    foreach ($emailData->email_to as $item) {
        if (!empty($item['name'])) {
            $toEmails[] = $item['name'];
        }
    }
}

// Send the email to all collected addresses
if (!empty($toEmails)) {
    Mail::to($toEmails)->send(new BookingSubmitted($data));
}

    return redirect()->back()->with('success', 'Booking submitted successfully!');
}




public function submitcasting(Request $request)
{
    $request->validate([
        'photo1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'photo2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'photo3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'photo4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->except(['photo1', 'photo2', 'photo3', 'photo4']);

    // Individual files
    $photo1 = $request->file('photo1');
    $photo2 = $request->file('photo2');
    $photo3 = $request->file('photo3');
    $photo4 = $request->file('photo4');


    $emailData = Seting::first();

      $toEmails = [];

if (!empty($emailData->email_to) && is_array($emailData->email_to)) {
    foreach ($emailData->email_to as $item) {
        if (!empty($item['name'])) {
            $toEmails[] = $item['name'];
        }
    }
}

if (!empty($toEmails)) {
    Mail::to($toEmails)->send(new ApplicationMail($data, $photo1, $photo2, $photo3, $photo4));
}

    

    return back()->with('success', 'Application sent with multiple photos!');
}



}