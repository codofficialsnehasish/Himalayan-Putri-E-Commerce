<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Product;
use App\Models\Service;
use App\Models\OfferBanner;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->first();
        $sliders = Slider::where('is_visible',1)->get();
        $categorys = Category::where('is_visible',1)->where('is_home',1)->get();
        // $all_products = $categorys->pluck('products')->flatten();
        $all_products = Product::where('is_visible',1)
                                ->where('is_home',1)
                                ->with(['variations.options'])
                                ->limit(8)
                                ->orderBy('id','desc')
                                ->get();
        $new_products = Product::where('is_visible', 1)
                                ->where('is_home',1)
                                ->with(['variations.options'])
                                ->orderBy('created_at', 'desc')
                                ->limit(8)
                                ->get();
        $brands = Brand::where('is_visible',1)->where('is_home',1)->get();
        $testimonials = Testimonial::where('is_visible',1)->get();
        $featured_products = Product::where('is_featured',1)
                                    ->where('is_visible',1)
                                    ->where('is_home',1)
                                    ->with(['variations.options'])
                                    ->limit(8)
                                    ->orderBy('id','desc')
                                    ->get();
        $best_selling_products = Product::withCount(['OrderItems as total_sold' => function($query) {
                                    $query->select(DB::raw('SUM(quantity)'));
                                }])
                                ->where('is_visible', 1)
                                ->orderBy('total_sold', 'DESC')
                                ->limit(8)
                                ->get();
        $services = Service::where('is_visible', 1)->get();
        $offer_banners = OfferBanner::where('is_visible', 1)->get();
        return view('site.home',compact('page','sliders','categorys','brands','testimonials','featured_products','all_products','new_products','best_selling_products','services','offer_banners'));
    }

    public function frontendPage($slug)
    {
        $page = Page::where('slug', $slug)->where('is_visible',1)->firstOrFail();

        return view('site.page', compact('page'));
    }
}

