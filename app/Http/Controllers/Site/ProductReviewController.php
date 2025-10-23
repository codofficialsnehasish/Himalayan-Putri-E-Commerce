<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ReviewImage;
use App\Models\ReviewHelpful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'title' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'recommend' => 'nullable|boolean',
        ]);

        $review = $product->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'title' => $request->title,
            'comment' => $request->comment,
            'is_verified' => true, // Set to true if you verify purchases
            'recommend' => $request->has('recommend'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('review_images', 'public');
                $review->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function markHelpful(Request $request, ProductReview $review)
    {
        $user = Auth::user();

        $existing = ReviewHelpful::where('review_id', $review->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            $existing->update(['is_helpful' => !$existing->is_helpful]);
        } else {
            ReviewHelpful::create([
                'review_id' => $review->id,
                'user_id' => $user->id,
                'is_helpful' => true,
            ]);
        }

        return response()->json([
            'helpful_count' => $review->helpful_count,
            'not_helpful_count' => $review->not_helpful_count,
        ]);
    }
}