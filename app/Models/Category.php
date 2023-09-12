<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function filter()
    {
        return $this->hasOne(Filter::class, 'category_id');
    }

    // many to many relationships between products and categories
    public function productBelongsToCategories()
    {
        return $this->belongsToMany(Product::class);
    }
}
