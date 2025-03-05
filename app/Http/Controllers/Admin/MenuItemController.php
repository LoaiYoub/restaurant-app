<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use League\Csv\Writer;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MenuItem::with('category');

        // Handle search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Handle filters
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Handle sorting
        $sortField = $request->input('sort_by', 'name');
        $sortDirection = $request->input('sort_direction', 'asc');

        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['name', 'price', 'status', 'created_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->orderBy('name', 'asc');
        }

        $menuItems = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.menu-items.index', compact('menuItems', 'categories'));
    }

    public function export(Request $request)
    {
        $query = MenuItem::with('category');

        // Apply the same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $menuItems = $query->get();

        // Create CSV
        $csv = Writer::createFromString('');
        $csv->insertOne([
            'Name',
            'Description',
            'Category',
            'Price',
            'Status',
            'Created At'
        ]);

        foreach ($menuItems as $item) {
            $csv->insertOne([
                $item->name,
                $item->description,
                $item->category->name,
                $item->price,
                $item->status,
                $item->created_at->format('Y-m-d H:i:s')
            ]);
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="menu-items.csv"',
        ];

        return response($csv->toString(), 200, $headers);
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
        // Transform checkbox values before validation
        $data = $request->all();
        $data['is_vegetarian'] = $request->has('is_vegetarian');
        $data['is_gluten_free'] = $request->has('is_gluten_free');
        $data['is_featured'] = $request->has('is_featured');

        // Validate the request
        $validatedData = Validator::make($data, [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'preparation_time' => 'nullable|integer|min:1',
            'calories' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_vegetarian' => 'boolean',
            'is_gluten_free' => 'boolean',
            'is_featured' => 'boolean',
        ])->validate();

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('menu-items', $imageName, 'public');
                $validatedData['image_path'] = $imagePath;
            }

            // Create menu item
            $menuItem = MenuItem::create($validatedData);

            return redirect()
                ->route('admin.menu-items.index')
                ->with('success', 'Menu item created successfully.');

        } catch (\Exception $e) {
            Log::error('Error creating menu item: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create menu item. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        $menuItem->load(['category', 'reviews.user']);
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
        // Transform checkbox values before validation
        $data = $request->all();
        $data['is_vegetarian'] = $request->has('is_vegetarian');
        $data['is_gluten_free'] = $request->has('is_gluten_free');
        $data['is_featured'] = $request->has('is_featured');

        // Validate the request
        $validatedData = Validator::make($data, [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'preparation_time' => 'nullable|integer|min:1',
            'calories' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_vegetarian' => 'boolean',
            'is_gluten_free' => 'boolean',
            'is_featured' => 'boolean',
        ])->validate();

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($menuItem->image_path) {
                    Storage::disk('public')->delete($menuItem->image_path);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('menu-items', $imageName, 'public');
                $validatedData['image_path'] = $imagePath;
            }

            // Update menu item
            $menuItem->update($validatedData);

            return redirect()
                ->route('admin.menu-items.index')
                ->with('success', 'Menu item updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error updating menu item: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update menu item. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
{
    try {
        // Delete the associated image if it exists
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }

        // Delete the menu item
        $menuItem->delete();

        return redirect()
            ->route('admin.menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    } catch (\Exception $e) {
        Log::error('Error deleting menu item: ' . $e->getMessage());

        return back()->withErrors(['error' => 'Failed to delete menu item. Please try again.']);
    }
}
}
