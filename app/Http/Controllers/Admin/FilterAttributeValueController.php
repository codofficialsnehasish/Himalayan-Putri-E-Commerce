<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FilterAttribute;
use App\Models\FilterAttributeValue;
use Illuminate\Http\Request;

class FilterAttributeValueController extends Controller
{
    public function index(FilterAttribute $filter_attribute)
    {
        $values = $filter_attribute->values()->latest()->get();
        return view('admin.filter-attribute-values.index', compact('filter_attribute', 'values'));
    }

    public function store(Request $request, FilterAttribute $filter_attribute)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255'
        ]);

        $filter_attribute->values()->create($validated);

        return back()->with('success', 'Value added successfully');
    }

    public function update(Request $request, FilterAttribute $filter_attribute, FilterAttributeValue $value)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255'
        ]);

        $value->update($validated);

        return back()->with('success', 'Value updated successfully');
    }

    public function destroy(FilterAttribute $filter_attribute, FilterAttributeValue $value)
    {
        $value->delete();
        return back()->with('success', 'Value deleted successfully');
    }
}