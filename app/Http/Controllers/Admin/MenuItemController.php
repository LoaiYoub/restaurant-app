<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MenuItem::with('category');

        // Handle search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Handle filters
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('availability')) {
            $query->where('availability', $request->availability);
        }

        // Handle sorting
        $sortField = $request->sort_by ?? 'name';
        $sortDirection = $request->sort_direction ?? 'asc';
        $query->orderBy($sortField, $sortDirection);

        $menuItems = $query->paginate(10);
        $categories = Category::all();

        return view('admin.menu-items.index', compact('menuItems', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menu-items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_vegetarian' => 'boolean',
            'is_gluten_free' => 'boolean',
            'is_featured' => 'boolean',
            'preparation_time' => 'nullable|integer|min:0',
            'calories' => 'nullable|integer|min:0',
            'availability' => ['required', Rule::in(['available', 'sold_out', 'seasonal'])],
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image_path'] = $request->file('image')->store('menu-items', 'public');
        }

        MenuItem::create($validatedData);

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        $menuItem->load(['category', 'addons', 'reviews.user']);
        return view('admin.menu-items.show', compact('menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_vegetarian' => 'boolean',
            'is_gluten_free' => 'boolean',
            'is_featured' => 'boolean',
            'preparation_time' => 'nullable|integer|min:0',
            'calories' => 'nullable|integer|min:0',
            'availability' => ['required', Rule::in(['available', 'sold_out', 'seasonal'])],
        ]);

        // Set boolean fields to false if not present in the request
        $validatedData['is_vegetarian'] = $request->has('is_vegetarian');
        $validatedData['is_gluten_free'] = $request->has('is_gluten_free');
        $validatedData['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menuItem->image_path) {
                Storage::disk('public')->delete($menuItem->image_path);
            }

            $validatedData['image_path'] = $request->file('image')->store('menu-items', 'public');
        }

        $menuItem->update($validatedData);

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        // Delete image if exists
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }

        $menuItem->delete();

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
