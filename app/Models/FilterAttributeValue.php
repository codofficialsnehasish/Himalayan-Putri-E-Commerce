<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FilterAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['filter_attribute_id', 'value'];

    public function attribute()
    {
        return $this->belongsTo(FilterAttribute::class, 'filter_attribute_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_filter_attribute_values');
    }
}