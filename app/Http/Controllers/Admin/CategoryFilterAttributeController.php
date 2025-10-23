<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FilterAttribute;
use Illuminate\Http\Request;

class CategoryFilterAttributeController extends Controller
{
    public function edit(Category $category)
    {
        // Debugging - check if category is loaded
        \Log::info('Category ID: '.$category->id);
        $attributes = FilterAttribute::with(['values'])->get();
        $assignedAttributes = $category->filterAttributes()
            ->withPivot('sort_order')
            ->orderBy('sort_order')
            ->get();
            
        return view('admin.category.filter-attributes', compact('category', 'attributes', 'assignedAttributes'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'attributes' => 'array',
            'attributes.*.id' => 'exists:filter_attributes,id',
            'attributes.*.sort_order' => 'integer'
        ]);

        $syncData = collect($request->input('attributes', []))
            ->mapWithKeys(fn($attr) => [$attr['id'] => ['sort_order' => $attr['sort_order']]]);

        $category->filterAttributes()->sync($syncData);

        return back()->with('success', 'Filter attributes updated successfully');
    }
}