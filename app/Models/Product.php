<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // добавляем имя в список fillable свойств
        'article',
        'description',
        'color',
        'color_code',
        'in_stock',
        'price',
        'brand',
        'country',
        'date_add',
        'date_update',
        'quantity',
        'category_id',
        'size_id',
        'discount_id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function freeShipping()
    {
        return $this->belongsTo(FreeShipping::class);
    }

    //many to many relationship between Product and Size
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function sizeDetails()
    {
        return $this->hasMany(SizeDetail::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    // public function cart()
    // {
    //     return $this->hasMany(Cart::class);
    // }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    //many to many relationship between Product and Cart
    public function relatedCarts()
    {
        return $this->belongsToMany(Cart::class);
    }

    //many to many relationship between Product and Color
    public function colors()
    {
        return $this->belongsToMany(Color::class); // 'color_product' - им'я pivot таблиці можна передати другим аргументом якщо им'я pivot таблиці не збігається з дефолтним
    }

    // many to many relationships between products and categories
    public function categoryBelongsToProducts()
    {
        return $this->belongsToMany(Category::class);
    }
}
