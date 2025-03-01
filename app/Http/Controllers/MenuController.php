<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with(['menuItems' => function($query) {
            $query->where('availability', '!=', 'sold_out');
        }])->where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('menu.index', compact('categories'));
    }

    public function show(MenuItem $menuItem)
    {
        return view('menu.show', compact('menuItem'));
    }
}
