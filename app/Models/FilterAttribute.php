<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FilterAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'input_type'];

    public function values()
    {
        return $this->hasMany(FilterAttributeValue::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_filter_attributes')
                    ->withPivot('sort_order')
                    ->withTimestamps();
    }
}