<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferBanner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class OfferBannerController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:OfferBanner Show', only: ['index']),
            new Middleware('permission:OfferBanner Create', only: ['create', 'store']),
            new Middleware('permission:OfferBanner Edit', only: ['edit', 'update']),
            new Middleware('permission:OfferBanner Delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $offerBanners = OfferBanner::all();
        return view('admin.offer-banner.index', compact('offerBanners'));
    }

    public function create()
    {
        return view('admin.offer-banner.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $offerBanner = new OfferBanner();
        $offerBanner->heading = $request->heading;
        $offerBanner->title = $request->title;
        $offerBanner->is_visible = $request->is_visible;
        $offerBanner->save();

        if ($request->hasFile('image')) {
            $offerBanner->addMedia($request->file('image'))->toMediaCollection('offer-banner');
        }

        return redirect()->back()->with('success', 'Offer Banner Created Successfully');
    }

    public function edit(string $id)
    {
        $offerBanner = OfferBanner::findOrFail($id);
        return view('admin.offer-banner.edit', compact('offerBanner'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'heading' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_visible' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $offerBanner = OfferBanner::findOrFail($id);
        $offerBanner->heading = $request->heading;
        $offerBanner->title = $request->title;
        $offerBanner->is_visible = $request->is_visible;
        $offerBanner->update();

        if ($request->hasFile('image')) {
            $offerBanner->clearMediaCollection('offer-banner');
            $offerBanner->addMedia($request->file('image'))->toMediaCollection('offer-banner');
        }

        return redirect()->back()->with('success', 'Offer Banner Updated Successfully');
    }

    public function destroy(string $id)
    {
        $offerBanner = OfferBanner::find($id);

        if ($offerBanner) {
            $offerBanner->clearMediaCollection('offer-banner');
            $offerBanner->delete();
            return back()->with('success', 'Offer Banner Deleted Successfully');
        }

        return back()->with('error', 'Offer Banner Not Found');
    }
}
