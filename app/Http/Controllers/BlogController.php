<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\Blog;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
  public function index()
{
    // Get the latest blog (only 1)
    $latest = Blog::where('status', 1)->latest()->first();

    // Get all other blogs excluding the latest, paginated
    $data = Blog::where('status', 1)
                ->where('id', '!=', optional($latest)->id)
                ->latest()
                ->paginate(6); // change per page as needed

    return view('blog', compact('latest', 'data'));
}


public function blogdetails($slug)
{
    $data = Blog::where('slug', $slug)->where('status', 1)->first();
     $blog = Blog::where('status', 1)->get()->take(3);
        
    return view('blogdetails', compact('data','blog'));
}

 

}