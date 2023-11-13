<?php

namespace App\Http\Controllers;

use App\Models\Reading;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function search()
    {
        $locations = [];
        $readings = Reading::where('reading_text', 'like', '%' . request('search') . '%')->get();

        
        return view('home', compact('readings','locations'));
    }
}
  