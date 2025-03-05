<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('name')->get();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        Table::create($validated);

        return redirect()
            ->route('admin.tables.index')
            ->with('success', 'Table created successfully.');
    }

    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name,' . $table->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $table->update($validated);

        return redirect()
            ->route('admin.tables.index')
            ->with('success', 'Table updated successfully.');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()
            ->route('admin.tables.index')
            ->with('success', 'Table deleted successfully.');
    }
}
