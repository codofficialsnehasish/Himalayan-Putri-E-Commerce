<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    protected $fillable = [
        'product_id', 
        'video_link',
        'is_visible'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
