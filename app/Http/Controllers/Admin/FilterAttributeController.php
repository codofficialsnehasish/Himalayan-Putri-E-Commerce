<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FilterAttribute;
use Illuminate\Http\Request;

class FilterAttributeController extends Controller
{
    public function index(Request $request)
    {
        $attributes = FilterAttribute::withCount('values')
            ->when($request->search, function($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('slug', 'like', '%'.$request->search.'%');
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.filter-attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.filter-attributes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:filter_attributes',
        ]);

        FilterAttribute::create($validated);

        return redirect()->route('filter-attributes.index')
            ->with('success', 'Filter attribute created successfully');
    }

    public function edit(FilterAttribute $filter_attribute)
    {
        return view('admin.filter-attributes.edit', compact('filter_attribute'));
    }

    public function update(Request $request, FilterAttribute $filter_attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:filter_attributes,slug,'.$filter_attribute->id,
        ]);

        $filter_attribute->update($validated);

        return redirect()->route('filter-attributes.index')
            ->with('success', 'Filter attribute updated successfully');
    }

    public function destroy(FilterAttribute $filter_attribute)
    {
        $filter_attribute->delete();
        return redirect()->route('filter-attributes.index')
            ->with('success', 'Filter attribute deleted successfully');
    }
}