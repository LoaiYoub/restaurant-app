<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = MenuItem::where('is_featured', true)
            ->where('availability', 'available')
            ->take(4)
            ->get();

        return view('home', compact('featuredItems'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
