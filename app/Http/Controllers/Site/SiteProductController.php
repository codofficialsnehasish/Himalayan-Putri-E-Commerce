<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Product;

class SiteProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Sorting Logic
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'date_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('name', 'asc');
            }
        }

        // Pagination Limit (Default: 4 products per page)
        $perPage = $request->input('show', 50);

        $query->where('is_visible',1);
        
        // Fetch products with applied filters and pagination
        $products = $query->paginate($perPage)->withQueryString();

        return view('site.products.products', compact('products'));
        // $products = Product::orderBy('id','desc')->get();
        // return view('site.products.products',compact('products'));
    }

    public function product_details(string $slug){
        $product = Product::where('slug',$slug)->first();

        $categoryIds = $product->categories->pluck('id');
        
        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
                                        $query->whereIn('category_id', $categoryIds);
                                    })
                                    ->orWhere('brand_id', $product->brand_id)
                                    ->where('id', '!=', $product->id)
                                    ->inRandomOrder()
                                    ->take(4)
                                    ->get();

        $relatedProducts = $relatedProducts->reject(function ($relatedProduct) use ($product) {
            return $relatedProduct->id == $product->id;
        });

        $reviews = $product->reviews()
            // ->with(['user', 'images', 'helpfuls'])
            ->with(['user'])
            // ->where('is_approved', true)
            ->latest()->get();

        $ratingDistribution = $this->getRatingDistribution($product);
        $averageRating = $product->reviews()->where('is_approved', true)->avg('rating');
        // return $reviews;
                                    

        return view('site.products.product_details',compact('product','relatedProducts','reviews', 'ratingDistribution', 'averageRating'));
    }

    private function getRatingDistribution(Product $product)
    {
        $distribution = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0,
        ];

        $reviews = $product->reviews()
            ->where('is_approved', true)
            ->select('rating', \DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->get();

        $totalReviews = $reviews->sum('count');

        foreach ($reviews as $review) {
            $distribution[$review->rating] = $totalReviews > 0 
                ? round(($review->count / $totalReviews) * 100) 
                : 0;
        }

        return $distribution;
    }

    public function all_brands(Request $request){
        $query = Brand::query();

        // Sorting Logic
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_desc':
                    $query->orderBy('total_price', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('total_price', 'asc');
                    break;
                default:
                    $query->orderBy('name', 'asc');
            }
        }

        // Pagination Limit (Default: 4 brands per page)
        $perPage = $request->input('show', 50);

        $query->where('is_visible',1);
        
        // Fetch brands with applied filters and pagination
        $brands = $query->paginate($perPage)->withQueryString();

        return view('site.brands', compact('brands'));
    }

    public function products_by_brands(Request $request,string $slug){
        $brand = Brand::where('slug',$slug)->first();
        if($brand){
            $query = Product::query();
    
            // Sorting Logic
            if ($request->has('sort_by')) {   
                switch ($request->sort_by) {
                    case 'name_desc':
                        $query->orderBy('name', 'desc');
                        break;
                    case 'date_asc':
                        $query->orderBy('created_at', 'asc');
                        break;
                    case 'date_desc':
                        $query->orderBy('created_at', 'desc');
                        break;
                    default:
                        $query->orderBy('name', 'asc');
                }
            }
    
            // Pagination Limit (Default: 4 products per page)
            $perPage = $request->input('show', 50);
    
            $query->where('is_visible',1);
            $query->where('brand_id',$brand->id);
            
            // Fetch products with applied filters and pagination
            $products = $query->paginate($perPage)->withQueryString();
    
            return view('site.products.products', compact('products'));
        }else{
            return back()->with('error','No Data Found');
        }
    }

    public function all_categories(Request $request){
        $query = Category::query();

        // Sorting Logic
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_desc':
                    $query->orderBy('total_price', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('total_price', 'asc');
                    break;
                default:
                    $query->orderBy('name', 'asc');
            }
        }

        // Pagination Limit (Default: 4 brands per page)
        $perPage = $request->input('show', 50);

        $query->where('is_visible',1);
        $query->where('parent_id',null);
        
        // Fetch brands with applied filters and pagination
        $categorys = $query->paginate($perPage)->withQueryString();

        return view('site.categories', compact('categorys'));
    }

    // public function products_by_category(Request $request, string $slug)
    // {
    //     $category = Category::where('slug', $slug)->first();

    //     if (!$category) {
    //         return back()->with('error', 'No Data Found');
    //     }

    //     $query = Product::query();

    //     // Filter products by category (Many-to-Many relationship)
    //     $query->whereHas('categories', function ($q) use ($category) {
    //         $q->where('categories.id', $category->id);
    //     });

    //     // Sorting Logic
    //     if ($request->has('sort_by')) {
    //         switch ($request->sort_by) {
    //             case 'name_desc':
    //                 $query->orderBy('name', 'desc');
    //                 break;
    //             case 'date_asc':
    //                 $query->orderBy('created_at', 'asc');
    //                 break;
    //             case 'date_desc':
    //                 $query->orderBy('created_at', 'desc');
    //                 break;
    //             default:
    //                 $query->orderBy('name', 'asc');
    //         }
    //     }

    //     // Pagination Limit (Default: 4 products per page)
    //     $perPage = $request->input('show', 4);

    //     $query->where('is_visible', 1);

    //     // If you need to filter by brand, make sure $brand is defined or remove this line
    //     // $query->where('brand_id', $brand->id);

    //     // Fetch products with applied filters and pagination
    //     $products = $query->paginate($perPage)->withQueryString();

    //     return view('site.products.products', compact('products'));
    // }

    public function products_by_category(Request $request, string $slug)
    {
        $category = Category::with('filterAttributes.values')->where('slug', $slug)->first();

        if (!$category) {
            return back()->with('error', 'No Data Found');
        }

        $query = Product::query();

        // Filter products by category
        $query->whereHas('categories', function ($q) use ($category) {
            $q->where('categories.id', $category->id);
        });

        // Price Range Filter
        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('total_price', [
                $request->price_min,
                $request->price_max
            ]);
        }

        // Dynamic Filter Attributes
        if ($request->has('filters')) {
            $query->where(function($q) use ($request) {
                foreach ($request->filters as $attributeId => $values) {
                    if (!empty($values)) {
                        $q->orWhereHas('filterAttributeValues', function($q) use ($attributeId, $values) {
                            $q->where('filter_attribute_id', $attributeId)
                            ->whereIn('value', (array)$values);
                        });
                    }
                }
            });
        }

        // dd($query->toSql(), $query->getBindings());

        // Sorting Logic
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'date_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('name', 'asc');
            }
        }

        // Pagination
        $perPage = $request->input('show', 50);
        $query->where('is_visible', 1);
        $products = $query->paginate($perPage)->withQueryString();

        return view('site.products.products', compact('products', 'category'));
    }

}