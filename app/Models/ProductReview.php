<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'title',
        'comment',
        'is_approved',
        'is_verified',
        'recommend'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }

    public function helpfuls()
    {
        return $this->hasMany(ReviewHelpful::class);
    }

    public function getHelpfulCountAttribute()
    {
        return $this->helpfuls()->where('is_helpful', true)->count();
    }

    public function getNotHelpfulCountAttribute()
    {
        return $this->helpfuls()->where('is_helpful', false)->count();
    }
}